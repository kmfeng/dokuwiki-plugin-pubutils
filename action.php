<?php
/**
 * Toolbar integration for the Publication Utilities Plugin (Action Component)
 *
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @author  Daniel Strigl
 */

// must be run within DokuWiki
if (!defined('DOKU_INC')) die();
if (!defined('DOKU_PLUGIN')) define('DOKU_PLUGIN', DOKU_INC.'lib/plugins/');

require_once DOKU_PLUGIN.'action.php';

class action_plugin_pubutils extends DokuWiki_Action_Plugin {
    function register(&$controller) {
        $controller->register_hook('TOOLBAR_DEFINE', 'AFTER', $this, 'insert_button', array());
    }
    function insert_button(&$event, $param) {
        $event->data[] = array(
            'type'   => 'format',
            'title'  => 'Add a foldable Abstract and/or BibTeX section',
            'icon'   => '../../plugins/pubutils/bibtex.gif',
            'open'   => '[~~PUB]',
            'sample' => ' Abstract [~*~*~] BibTeX ',
            'close'  => '[PUB~~]'
        );
    }
}
?>
