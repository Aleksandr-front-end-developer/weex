(function($) {
    'use strict';

    var membershipFavorites = {};
    mkdf.modules.membershipFavorites = membershipFavorites;

    membershipFavorites.mkdfOnDocumentReady = mkdfOnDocumentReady;

    $(document).ready(mkdfOnDocumentReady);
    
    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function mkdfOnDocumentReady() {
        mkdfMembershipAddToWishlist();
        mkdfMembershipAddToWishlistTriggerEvent();
    }

    function mkdfMembershipAddToWishlist(){
        $('.mkdf-membership-item-favorites').on('click',function(e) {
            e.preventDefault();
            var item = $(this),
                itemID;

            if(typeof item.data('item-id') !== 'undefined') {
                itemID = item.data('item-id');
            }

            mkdfMembershipWhishlistAdding(item, itemID);
        });
    }

    function mkdfMembershipWhishlistAdding(item, itemID){
        var ajaxData = {
            action: 'biagiotti_membership_add_item_to_favorites',
            item_id : itemID
        };

        $.ajax({
            type: 'POST',
            data: ajaxData,
            url: mkdfGlobalVars.vars.mkdfAjaxUrl,
            success: function (data) {
                var response = JSON.parse(data);
                
                if(response.status === 'success'){
                    if(!item.hasClass('mkdf-icon-only')) {
                        item.find('span').text(response.data.message);
                    }
                    item.find('.mkdf-favorites-icon').removeClass('mkdf-favorite-inactive mkdf-favorite-active').addClass(response.data.icon);
                }
            }
        });

        return false;
    }

    function mkdfMembershipAddToWishlistTriggerEvent() {
        $( document.body ).on( 'biagiotti_membership_favorites_trigger', function() {
            mkdfMembershipAddToWishlist();
        });
    }

})(jQuery);