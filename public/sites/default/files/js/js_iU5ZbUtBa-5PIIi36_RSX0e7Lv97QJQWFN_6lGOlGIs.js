Drupal.locale = { 'strings': {"":{"Show row weights":"\u0625\u0638\u0647\u0627\u0631 \u0627\u0644\u0648\u0632\u0646 \u0644\u0644\u062a\u0631\u062a\u064a\u0628","Hide row weights":"\u0625\u062e\u0641\u0627\u0621 \u0627\u0644\u0648\u0632\u0646 \u0644\u0644\u062a\u0631\u062a\u064a\u0628","Upload":"\u0631\u0641\u0639 \u0627\u0644\u0645\u0644\u0641"}} };;
(function ($) {

Drupal.behaviors.textarea = {
  attach: function (context, settings) {
    $('.form-textarea-wrapper.resizable', context).once('textarea', function () {
      var staticOffset = null;
      var textarea = $(this).addClass('resizable-textarea').find('textarea');
      var grippie = $('<div class="grippie"></div>').mousedown(startDrag);

      grippie.insertAfter(textarea);

      function startDrag(e) {
        staticOffset = textarea.height() - e.pageY;
        textarea.css('opacity', 0.25);
        $(document).mousemove(performDrag).mouseup(endDrag);
        return false;
      }

      function performDrag(e) {
        textarea.height(Math.max(32, staticOffset + e.pageY) + 'px');
        return false;
      }

      function endDrag(e) {
        $(document).unbind('mousemove', performDrag).unbind('mouseup', endDrag);
        textarea.css('opacity', 1);
      }
    });
  }
};

})(jQuery);
;
