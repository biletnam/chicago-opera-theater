/* eslint no-undef: 0 */

(function () {
  tinymce.create('tinymce.plugins.button_shortcode_plugin', {

    // url argument holds the absolute url of our plugin directory
    init: function(ed, url) {
      // add new button
      ed.addButton('shortcode_button', {
        title: 'Button',
        cmd: 'button_shortcode',
        icon: 'fa fa-mouse-pointer',
      });

      // button functionality.
      ed.addCommand('button_shortcode', function () {
        var selectedText = ed.selection.getContent();
        var returnText = '[button href="#" class="is-primary" icon=""]' + selectedText + '[/button]';
        ed.execCommand('mceInsertContent', 0, returnText);
      });
    },

    createControl: function (n, cm) {
      return null;
    },

    getInfo: function () {
      return {
        longname: 'Extra Buttons',
        author: 'Joshua Bartlett',
        version: '1',
      };
    },
  });

  tinymce.PluginManager.add('button_shortcode_plugin', tinymce.plugins.button_shortcode_plugin);
})();
