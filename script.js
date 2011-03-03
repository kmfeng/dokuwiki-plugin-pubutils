/**
 * JavaScript functions needed by the Publication Utilities Plugin
 *
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @author  Daniel Strigl
 */

function toggle_title(elem) {
    var title = jQuery(elem).attr("title");
    var match = title.match(/(View|Hide)\s+(\w+)/);
    if (match) {
        // Visible?
        if (jQuery(elem).hasClass("aPubUtils_OPEN")) {
            jQuery(elem).attr("title", "Hide " + match[2]);
        }
        // Hidden?
        else {
            jQuery(elem).attr("title", "View " + match[2]);
        }
    }
}

function pubutils_setup() {
    // BibTeX
    jQuery(".aPubUtils_BibTeX").map(function(){
        jQuery(this).toggle(function(){
            jQuery(this).siblings("pre.prePubUtils_BibTeX").animate({ height: 'show', opacity: 'show' }, 'normal');
            },function(){
            jQuery(this).siblings("pre.prePubUtils_BibTeX").animate({ height: 'hide', opacity: 'hide' }, 'normal');
        });
        jQuery(this).click(function(){
            jQuery(this).toggleClass("aPubUtils_OPEN");
            toggle_title(this);
        });
    });
    // Abstract
    jQuery(".aPubUtils_Abstract").map(function(){
        jQuery(this).toggle(function(){
            jQuery(this).siblings("div.divPubUtils_Abstract").animate({ height: 'show', opacity: 'show' }, 'normal');
            },function(){
            jQuery(this).siblings("div.divPubUtils_Abstract").animate({ height: 'hide', opacity: 'hide' }, 'normal');
        });
        jQuery(this).click(function(){
            jQuery(this).toggleClass("aPubUtils_OPEN");
            toggle_title(this);
        });
    });
}

addInitEvent(pubutils_setup);
