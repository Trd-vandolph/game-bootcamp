(function($) { 'use strict';
    String.prototype.startsWith = function(prefix) {
        return this.indexOf(prefix) === 0;
    };

    Number.prototype.zeroFill = function(n) {
        if (this < 0 || (this - Math.floor(this) !== 0)) {
            return this.toString();
        }
        var zero =
            new Array((n + 1) - this.toString().split('').length).join('0');
        return zero + this;
    };

    Array.prototype.include = function(v) {
        for (var i = 0, len = this.length; i < len; i++) {
            if (this[i] == v) {
                return true;
            }
        }
        return false;
    };

    Array.prototype.last = function(v) {
        return this.length ? this[this.length - 1] : null;
    };

    Array.prototype.min = function(v) {
        var min = this[0];
        for (var i = 1, len = this.length; i < len; i++) {
            if (this[i] < min) {
                min = this[i];
            }
        }
        return min;
    };

    Date.prototype.toLocaleString = function() {
        return [
            this.getFullYear(), '/',
            (this.getMonth() + 1).zeroFill(2), '/',
            this.getDate().zeroFill(2), ' ',
            this.getHours().zeroFill(2), ':',
            this.getMinutes().zeroFill(2), ':',
            this.getSeconds().zeroFill(2)
        ].join('');
    };

    Date.prototype.toLocaleDateString = function() {
        return [
            this.getFullYear(),
            (this.getMonth() + 1).zeroFill(2),
            this.getDate().zeroFill(2)
        ].join('/');
    };

    Date.prototype.getTimeInSec = function() {
        return this.getTime() / 1000;
    };
})(jQuery);

/*
 * optimized smartRollover based on
 * http://css-happylife.com/archives/2007/0621_0010.php
 */
(function($) { 'use strict';
    $(document).ready(function() {
        var roff = /_off\./;
        var cachedImages = [];

        $('img, input[type="image"]').each(function() {
            var img = $(this);
            var src = img.attr('src') || '';
            var width = img.attr('width') || 1;
            var height = img.attr('height') || 1;
            if (!roff.exec(src)) {
                return;
            }
            var endswithon = src.replace(roff, '_on.');
            img.data('hover-image-off', src)
            .data('hover-image-on', endswithon)
            .hover(function() {
                $(this).attr('src', img.data('hover-image-on'));
            }, function() {
                $(this).attr('src', img.data('hover-image-off'));
            });
            cachedImages.push({
                url: endswithon,
                width: width,
                height: height
            });
        });
        var buf = [];
        $.each(cachedImages, function(idx, image) {
            buf.push('<img src="');
            buf.push(image.url);
            buf.push('" width="');
            buf.push(image.width);
            buf.push('" height="');
            buf.push(image.height);
            buf.push('"/>');
        });
        setTimeout(function() {
            var d = $('<div>').hide().html(buf.join('')).appendTo('body:first');
            $('> img', d).ready(function() {
                $(this).remove();
            });
        }, 1500);
    });
})(jQuery);

/*
 * Flatten height same as the highest element for each row.
 *
 * Copyright (c) 2011 Hayato Takenaka
 * Dual licensed under the MIT and GPL licenses:
 * http://www.opensource.org/licenses/mit-license.php
 * http://www.gnu.org/licenses/gpl.html
 */
(function($) { 'use strict';
    $.fn.tile = function(columns) {
        var tiles, max, c, h, last = this.length - 1, s;
        if (!columns) columns = this.length;
        this.each(function() {
            s = this.style;
            if (s.removeProperty) s.removeProperty('height');
            if (s.removeAttribute) s.removeAttribute('height');
        });
        return this.each(function(i) {
            c = i % columns;
            if (c === 0) tiles = [];
            tiles[c] = $(this);
            h = tiles[c].height();
            if (c === 0 || h > max) max = h;
            if (i == last || c == columns - 1)
                $.each(tiles, function() { this.height(max); });
        });
    };
	$.fn.tiles = function(columns, tile) {
		var _tile = tile || 'li';
		this.each(function() {
			$(_tile, this).tile(columns);
		});
		return true;
	};
})(jQuery);

/* open the window as target="_blank" */
(function($) { 'use strict';
    $(document).ready(function() {
        $('a.blank').on('click', function() {
            window.open($(this).attr('href'), '_blank');
            return false;
        });
    });
})(jQuery);

/* smooth scrolling */
(function($) { 'use strict';
    $(document).ready(function() {
        $('a[href^="#"]').on('click', function(event) {
            var a = $(this);
            var id = a.attr('href');
            var target = $(id).offset().top - 40;
            $('html, body').animate({
                scrollTop: target
            }, 400);
            event.preventDefault();
        });
    });
})(jQuery);

