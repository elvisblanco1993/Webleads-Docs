<?php

/**
 * ✔ pos. tested with Parsedown 1.7.4
 *
 * This allows usage of image dimensions this way:
 *      ![odyssee2001](http://example.com/Odyssey2001.png =100x100)
 *      ![odyssee2001](http://example.com/Odyssey2001.png =100x100 "Even with Title")
 *
 * @related
 * https://github.com/erusev/parsedown/issues/723
 * https://stackoverflow.com/a/21242579/2487859
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <info@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3.
 */
class BParsedown extends \Parsedown
{
    /**
     * @param $aExcerpt
     * @return array|void
     */
    protected function inlineImage($aExcerpt)
    {
        if ( ! isset($aExcerpt['text'][1]) or $aExcerpt['text'][1] !== '[')
        {
            return;
        }

        $aExcerpt['text'] = self::getRelevantMarkdown($aExcerpt['text']);
        $aExcerpt['text']= mb_substr($aExcerpt['text'], 1);

        // watch out for link
        $aLink = $this->inlineLink($aExcerpt);

        // grab infos from string...
        $sAlt = strtok(mb_substr(strchr($aExcerpt['text'], '['), 1), ']');
        $sTitle = strtok(mb_substr(strchr($aExcerpt['text'], '"'), 0), '"');
        $sUrl = current(self::getUrlFromString($aExcerpt['text']));
        $mStrChr = mb_strrchr($aExcerpt['text'], '=');
        list($iWidth, $iHeight) = (false !== $mStrChr) ? array_map('intval', explode('x', mb_substr($mStrChr, 1))) : array('', '');

        // ...or from Link
        (true === empty($sAlt) && isset($aLink['element']['text'])) ? $sAlt = $aLink['element']['text'] : false;
        (true === empty($sUrl) && isset($aLink['element']['attributes']['href'])) ? $sUrl = $aLink['element']['attributes']['href'] : false;
        (true === empty($sTitle) && isset($aLink['element']['attributes']['title'])) ? $sTitle = $aLink['element']['attributes']['title'] : false;
        (true === empty($iWidth) && isset($aLink['element']['attributes']['width'])) ? $iWidth = $aLink['element']['attributes']['width'] : false;
        (true === empty($iHeight) && isset($aLink['element']['attributes']['height'])) ? $iHeight = $aLink['element']['attributes']['height'] : false;

        (false === isset($sTitle) || true === empty($sTitle)) ? $sTitle = $sAlt : false;

        $aInline = parent::inlineImage($aExcerpt);
        $aInline['element']['name'] = 'img';
        $aInline['element']['attributes'] = [];
        $aInline['extent'] = mb_strlen($aExcerpt['text']) + 2;

        (false === empty($sUrl)) ? $aInline['element']['attributes']['src'] = $sUrl : false;
        (false === empty($sAlt)) ? $aInline['element']['attributes']['alt'] = $sAlt : false;
        (false === empty($sTitle)) ? $aInline['element']['attributes']['title'] = $sTitle : false;
        (false === empty($iWidth)) ? $aInline['element']['attributes']['width'] = $iWidth : false;
        (false === empty($iHeight)) ? $aInline['element']['attributes']['height'] = $iHeight : false;

        return $aInline;
    }

    /**
     * modified regex to match image dimensions in reference links
     * @example [1]: http://example.com/foo.png =50x50 "example image"
     * @see https://regexr.com/4rjlp
     * @see https://blog.ueffing.net/post/2020/01/01/parsedown-image-size-dimension-attribute/
     * @param string $sLine
     * @return array
     */
    protected function blockReference($sLine = '')
    {
        $bPregMatchLine = (boolean) preg_match(
            ''
            . '/^\[(.+?)\]:[ ]*<?(\S+?)>?'
            . '('
            .'?:'
            .'[\s]+[=]+[(0-9)]+[x]+[(0-9)]+[\s]'    # this (with image dimensions. e.g. =50x50)
            .'+["\'(](.+)["\')]'
            .'|'                                    # or
            .'[\s]+["\'(](.+)["\')]'                # that (without; standard)
            .')'
            . '?[ ]*$/',
            $sLine['text'],
            $aMatchLine
        );

        // skip empty ones
        $aMatchLine = array_values(array_filter($aMatchLine));

        if (true === $bPregMatchLine)
        {
            $iId = strtolower($aMatchLine[1]);
            $aData = array(
                'url' => $aMatchLine[2],
                'title' => null,
            );

            (isset($aMatchLine[3])) ? $aData['title'] = $aMatchLine[3] : false;

            IMAGE_DIMSENSION: {

                $sPatternImageDimension = '/[=]+[(0-9)]+[x]+[(0-9)]*/'; # e.g. =50x50
                $bPregMatchImageDimension = (boolean) preg_match(
                    $sPatternImageDimension,
                    $aMatchLine[0],
                    $aMatchImageDimension
                );

                if (true === $bPregMatchImageDimension)
                {
                    $sMatchImageDimension = current($aMatchImageDimension);
                    $mStrChr = mb_strrchr($sMatchImageDimension, '=');
                    list($aData['width'], $aData['height']) = (false !== $mStrChr) ? array_map('intval', explode('x', mb_substr($mStrChr, 1))) : array('', '');
                }
            }

            $this->DefinitionData['Reference'][$iId] = $aData;
            $aBlock = array('hidden' => true);

            return $aBlock;
        }
    }

    /**
     * @param array $aExcerpt
     * @return array|void
     */
    protected function inlineLink($aExcerpt)
    {
        $iExtent = 0;
        $sText = $aExcerpt['text'];
        $aElement = array(
            'name' => 'a',
            'handler' => 'line',
            'nonNestables' => array('Url', 'Link'),
            'text' => null,
            'attributes' => array(
                'href' => null,
                'title' => null,
            ),
        );

        if (preg_match('/\[((?:[^][]++|(?R))*+)\]/', $sText, $aMatch))
        {
            $aElement['text'] = $aMatch[1];
            $iExtent += strlen($aMatch[0]);
            $sText = substr($sText, $iExtent);
        }
        else
        {
            return;
        }

        if (preg_match('/^[(]\s*+((?:[^ ()]++|[(][^ )]+[)])++)(?:[ ]+("[^"]*"|\'[^\']*\'))?\s*[)]/', $sText, $aMatch))
        {
            $aElement['attributes']['href'] = $aMatch[1];
            (isset($aMatch[2])) ? $aElement['attributes']['title'] = substr($aMatch[2], 1, - 1) : false;
            $iExtent += strlen($aMatch[0]);
        }
        else
        {
            if (preg_match('/^\s*\[(.*?)\]/', $sText, $aMatch))
            {
                $sDefinition = strlen($aMatch[1]) ? $aMatch[1] : $aElement['text'];
                $sDefinition = strtolower($sDefinition);
                $iExtent += strlen($aMatch[0]);
            }
            else
            {
                $sDefinition = strtolower($aElement['text']);
            }

            if ( ! isset($this->DefinitionData['Reference'][$sDefinition]))
            {
                return;
            }

            $aDefinition = $this->DefinitionData['Reference'][$sDefinition];

            $aElement['attributes']['href'] = $aDefinition['url'];
            $aElement['attributes']['title'] = $aDefinition['title'];

            (isset($aDefinition['width'])) ? $aElement['attributes']['width'] = $aDefinition['width'] : false;
            (isset($aDefinition['height'])) ? $aElement['attributes']['height'] = $aDefinition['height'] : false;
        }

        $aReturn = array(
            'extent' => $iExtent,
            'element' => $aElement,
        );

        return $aReturn;
    }

    /**
     * @param string $sText
     * @return mixed|string
     */
    protected static function getRelevantMarkdown($sText = '')
    {
        $aExplode = preg_split("@!\[@", $sText, NULL, PREG_SPLIT_NO_EMPTY);
        $sValue = '';

        foreach ($aExplode as $iKey => $sValue)
        {
            $sValue = '![' . strtok($sValue, ')') . ')';
            $sValue = strtok($sValue, ')');
            if ($sValue[1] != '['){continue;} # skip irrelevant
            break;
        }

        // this is what we want
        return $sValue;
    }

    /**
     * @param string $sContent
     * @return array
     */
    protected static function getUrlFromString($sContent = '')
    {
        $sPattern = "/(?:(?:\/|https?|ftp))[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i";

        preg_match_all(
            $sPattern,
            $sContent,
            $aMatch,
            PREG_PATTERN_ORDER
        );

        return current($aMatch);
    }
}