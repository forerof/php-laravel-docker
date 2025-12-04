(function($) {
    $(document).ready(function() {
        // Control de cantidad
        $('.inumber-increment').click(function() {
            var input = $(this).siblings('.input-number');
            var max = parseInt(input.attr('max'));
            var val = parseInt(input.val());
            if (val < max) {
                input.val(val + 1);
            }
        });

        $('.inumber-decrement').click(function() {
            var input = $(this).siblings('.input-number');
            var min = parseInt(input.attr('min'));
            var val = parseInt(input.val());
            if (val > min) {
                input.val(val - 1);
            }
        });

        // Rating select preview
        function renderRatingPreview(value) {
            var html = '';
            var v = parseInt(value) || 0;
            for (var i = 1; i <= 5; i++) {
                if (i <= v) {
                    html += '<i class="fa fa-star"></i>';
                } else {
                    html += '<i class="fa fa-star-o"></i>';
                }
            }
            $('#rating-preview').html(html);
        }

        $('#rating-select').on('change', function() {
            renderRatingPreview(this.value);
        });

        // Init preview
        renderRatingPreview($('#rating-select').val());
    });
})(jQuery);
