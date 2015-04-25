/* 
 * @Author: Siarhei
 * @Date:   2015-03-06 23:54:36
 * @Last Modified by:   Siarhei
 * @Last Modified time: 2015-04-04 01:10:41
 */

var Slider = (function() {

	// Private vars	

	return {

		// Init module
		init: function() {

			$(".owl-carousel").owlCarousel({
				slideSpeed : 300,
				paginationSpeed : 400,
				singleItem:true
			});

		}

	}

})();
