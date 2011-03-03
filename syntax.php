<?php
/**
 * DokuWiki Publication Utilities Plugin (Syntax Component)
 *
 * <b>Required plugins:</b>
 *   <a href="https://github.com/cosmocode/dokuwiki-plugin-jquery">jQuery plugin</a>
 *
 * <b>Syntax:</b>
 *   <pre>[~~PUB] Abstract [~*~*~] BibTeX [PUB~~]</pre>
 *
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @author  Daniel Strigl
 */

// must be run within DokuWiki
if (!defined('DOKU_INC')) die();
if (!defined('DOKU_PLUGIN')) define('DOKU_PLUGIN', DOKU_INC.'lib/plugins/');

require_once DOKU_PLUGIN.'syntax.php';

class syntax_plugin_pubutils extends DokuWiki_Syntax_Plugin {

    function getInfo(){
        return array(
            'author' => 'Daniel Strigl',
            'email'  => '',
            'date'   => '2011-02-24',
            'name'   => 'Publication Utilities Plugin',
            'desc'   => 'Foldable sections for the Abstract and BibTeX entry of a publication.
                         Requires the jQuery plugin (https://github.com/cosmocode/dokuwiki-plugin-jquery).
                         Syntax:
                         [~~PUB] Abstract [~*~*~] BibTeX [PUB~~]',
            'url'    => 'http://danielstrigl.com/'
        );
    }

    function getType() { return 'substition'; }
    function getAllowedTypes() { return array('formatting', 'substition', 'disabled'); }
    function getPType() { return 'normal'; }
    function getSort() { return 444; }

    function connectTo($mode) {
        $this->Lexer->addSpecialPattern('\[~~PUB\][\s\S]*?\[~\*~\*~\][\s\S]*?\[PUB~~\]', $mode, 'plugin_pubutils');
    }
    function handle($match, $state, $pos, &$handler) {
        if (preg_match('/\[~~PUB\]([\s\S]*?)\[~\*~\*~\]([\s\S]*?)\[PUB~~\]/', $match, $data)) {
            if (count($data) == 3) {
                $abstract = trim($data[1]);
                $bibtex = trim($data[2]);
                if (!empty($abstract) or !empty($bibtex)) {
                    $str = '<div>';
                    if (!empty($abstract))
                        $str .= '<a href="#" class="aPubUtils_Abstract" title="View Abstract">Abstract</a>';
                    if (!empty($bibtex))
                        $str .= '<a href="#" class="aPubUtils_BibTeX" title="View BibTeX">BibTeX</a>';
                    if (!empty($abstract))
                        $str .= '<div class="divPubUtils_Abstract">'.$abstract.'</div>';
                    if (!empty($bibtex))
                        $str .= '<pre class="prePubUtils_BibTeX">'.$bibtex.'</pre>';
                    $str .= '</div>';
                }
                return $str;
            }
        }
        return '';
    }
    function render($mode, &$renderer, $data) {
        if ($mode == 'xhtml') {
            $renderer->doc .= $data;
            return true;
        }
        return false;
    }
}
?>
