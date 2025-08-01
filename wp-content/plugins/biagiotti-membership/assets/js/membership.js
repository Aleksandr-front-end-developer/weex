// Load the SDK asynchronously
(function (d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) {
        return;
    }
    js = d.createElement(s);
    js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
if (typeof mkdfSocialLoginVars !== 'undefined') {
    var facebookAppId = mkdfSocialLoginVars.social.facebookAppId;
}
if (facebookAppId) {
    window.fbAsyncInit = function () {
        FB.init({
            appId: facebookAppId, //265124653818954 - test app ID
            cookie: true,  // enable cookies to allow the server to access
            xfbml: true,  // parse social plugins on this page
            version: 'v2.5' // use version 2.5
        });

        window.FB = FB;
    };
}

(function ($) {
    "use strict";

    var socialLogin = {};
    if ( typeof mkdf !== 'undefined' ) {
        mkdf.modules.socialLogin = socialLogin;
    }

    socialLogin.mkdfUserLogin = mkdfUserLogin;
    socialLogin.mkdfUserRegister = mkdfUserRegister;
    socialLogin.mkdfUserLostPassword = mkdfUserLostPassword;
    socialLogin.mkdfInitWidgetModal = mkdfInitWidgetModal;
    socialLogin.mkdfInitFacebookLogin = mkdfInitFacebookLogin;
    socialLogin.mkdfRenderAjaxResponseMessage = mkdfRenderAjaxResponseMessage;

    $(document).ready(mkdfOnDocumentReady);
    $(window).on('load', mkdfOnWindowLoad);

    /**
     * All functions to be called on $(document).ready() should be in this function
     */
    function mkdfOnDocumentReady() {
        mkdfInitWidgetModal();
        mkdfUserLogin();
        mkdfUserRegister();
        mkdfUserLostPassword();
	    mkdfInitLoginTabs();
    }

    /**
     * All functions to be called on $(window).load() should be in this function
     */
    function mkdfOnWindowLoad() {
        mkdfInitFacebookLogin();
        mkdfMembershipFullScreen();
    }

    /**
     * Initialize register widget modal
     */
    function mkdfInitWidgetModal() {
        var modalOpeners = $('.mkdf-modal-opener'),
            modalHolders = $('.mkdf-modal-holder'),
	        modalPopupCloseBtn = $('.mkdf-login-popup-close-btn');

        if (modalOpeners.length && modalHolders.length) {

            //Init opening login modal
            modalOpeners.on( 'click',function (e) {
                e.preventDefault();
                var thisModalOpener = $(this);
                var type = thisModalOpener.data("modal");
                modalHolders.fadeOut(300);
                modalHolders.removeClass('opened');
                modalHolders.each(function(){
                    var thisModalHolder = $(this);
                    if(thisModalHolder.data('modal') !== 'undefined' && thisModalHolder.data('modal') === type) {
                        thisModalHolder.fadeIn(300);
                        thisModalHolder.addClass('opened');
                    }
                });
            });

            modalHolders.each(function() {
                var thisModalHolder = $(this);

                //Init closing login modal
                thisModalHolder.on('click', function (e) {
                    if (thisModalHolder.hasClass('opened')) {
                        thisModalHolder.fadeOut(300);
                        thisModalHolder.removeClass('opened');
                    }
                });
	
	            modalPopupCloseBtn.on('click', function (e) {
		            if (thisModalHolder.hasClass('opened')) {
			            thisModalHolder.fadeOut(300);
			            thisModalHolder.removeClass('opened');
		            }
	            });
                
                // on esc too
                $(window).on('keyup', function (e) {
                    if (thisModalHolder.hasClass('opened') && e.keyCode === 27) {
                        thisModalHolder.fadeOut(300);
                        thisModalHolder.removeClass('opened');
                    }
                });

                var modalContent = thisModalHolder.find('.mkdf-modal-content');
                modalContent.on('click', function (e) {
                    e.stopPropagation();
                });
            });
        }
    }

    /**
     * Login user via Ajax
     */
    function mkdfUserLogin() {
        $('.mkdf-login-form').on('submit', function (e) {
            e.preventDefault();
            
            var ajaxData = {
                action: 'biagiotti_membership_login_user',
                security: $(this).find('#mkdf-login-security').val(),
                login_data: $(this).serialize()
            };
            
            $.ajax({
                type: 'POST',
                data: ajaxData,
                url: mkdfGlobalVars.vars.mkdfAjaxUrl,
                success: function (data) {
                    var response;
                    response = JSON.parse(data);

                    mkdfRenderAjaxResponseMessage(response);
                    if (response.status === 'success') {
                        window.location = response.redirect;
                    }
                }
            });
            
            return false;
        });
    }

    /**
     * Register New User via Ajax
     */
    function mkdfUserRegister() {
        $('.mkdf-register-form').on('submit', function (e) {
            e.preventDefault();
            
            var ajaxData = {
                action: 'biagiotti_membership_register_user',
                security: $(this).find('#mkdf-register-security').val(),
                register_data: $(this).serialize()
            };

            $.ajax({
                type: 'POST',
                data: ajaxData,
                url: mkdfGlobalVars.vars.mkdfAjaxUrl,
                success: function (data) {
                    var response;
                    response = JSON.parse(data);

                    mkdfRenderAjaxResponseMessage(response);
                    if (response.status === 'success') {
                        window.location = response.redirect;
                    }
                }
            });

            return false;
        });
    }

    /**
     * Reset user password
     */
    function mkdfUserLostPassword() {
        var lostPassForm = $('.mkdf-reset-pass-form');
        
        lostPassForm.on('submit', function (e) {
            e.preventDefault();
            
            var data = {
                action: 'biagiotti_membership_user_lost_password',
                user_login: lostPassForm.find('#user_reset_password_login').val()
            };
            
            $.ajax({
                type: 'POST',
                data: data,
                url: mkdfGlobalVars.vars.mkdfAjaxUrl,
                success: function (data) {
                    var response = JSON.parse(data);
                    mkdfRenderAjaxResponseMessage(response);
                    if (response.status === 'success') {
                        window.location = response.redirect;
                    }
                }
            });
        });
    }

    /**
     * Response notice for users
     * @param response
     */
    function mkdfRenderAjaxResponseMessage(response) {
        var responseHolder = $('.mkdf-membership-response-holder'), //response holder div
            responseTemplate = _.template($('.mkdf-membership-response-template').html()); //Locate template for info window and insert data from marker options (via underscore)

        var messageClass;
        if (response.status === 'success') {
            messageClass = 'mkdf-membership-message-succes';
        } else {
            messageClass = 'mkdf-membership-message-error';
        }

        var templateData = {
            messageClass: messageClass,
            message: response.message
        };

        var template = responseTemplate(templateData);
        responseHolder.html(template);
    }

    /**
     * Facebook Login
     */
    function mkdfInitFacebookLogin() {
        var loginForm = $('.mkdf-facebook-login-holder');
        loginForm.on('submit', function (e) {
            e.preventDefault();
            
            window.FB.login(function (response) {
                mkdfFacebookCheckStatus(response);
            }, {scope: 'email, public_profile'});
        });
    }

    /**
     * Check if user is logged into Facebook and App
     *
     * @param response
     */
    function mkdfFacebookCheckStatus(response) {
        if (response.status === 'connected') {
            // Logged into your app and Facebook.
            mkdfGetFacebookUserData(response.authResponse.accessToken);
        } else if (response.status === 'not_authorized') {
            // The person is logged into Facebook, but not your app.
            console.log('Please log into this app');
        } else {
            // The person is not logged into Facebook, so we're not sure if
            // they are logged into this app or not.
            console.log('Please log into Facebook');
        }
    }

    /**
     * Get user data from Facebook and login user
     */
    function mkdfGetFacebookUserData( accessToken ) {
        console.log('Welcome! Fetching information from Facebook...');
        FB.api('/me', 'GET', {'fields': 'id, name, email, link, picture'}, function (response) {
            var nonce = $('.mkdf-facebook-login-holder [name^=mkdf_nonce_facebook_login]').val();
            response.nonce       = nonce;
            response.image       = response.picture.data.url;
            response.accessToken = accessToken;
            var data = {
                action: 'biagiotti_membership_check_facebook_user',
                response: response
            };
            $.ajax({
                type: 'POST',
                data: data,
                url: mkdfGlobalVars.vars.mkdfAjaxUrl,
                success: function (data) {
                    var response;
                    response = JSON.parse(data);

                    mkdfRenderAjaxResponseMessage(response);
                    if (response.status === 'success') {
                        window.location = response.redirect;
                    }
                }
            });
        });
    }

    function mkdfMembershipFullScreen() {
        var membership = $('.mkdf-membership-main-wrapper');
        var profileContent = $('.page-template-user-dashboard .mkdf-content');
        var footer = $('.mkdf-page-footer');
        var reduceHeight = 0;

        if(!mkdf.body.hasClass('mkdf-header-transparent') && mkdf.windowWidth > 1024) {
            reduceHeight = reduceHeight + mkdfGlobalVars.vars.mkdfMenuAreaHeight + mkdfGlobalVars.vars.mkdfLogoAreaHeight;
        }
        if(footer.length > 0) {
            reduceHeight += footer.outerHeight();
        }

        if(mkdf.windowWidth > 1024) {
            var height = mkdf.windowHeight - reduceHeight;
            profileContent.css({'min-height': height  + 'px'});
        }
    }
	
	function mkdfInitLoginTabs(){
		var tabs = $('.mkdf-login-tabs');
		
		if(tabs.length){
			tabs.each(function(){
				var thisTabs = $(this);
				
				thisTabs.children('.mkdf-tab-container').each(function(index){
					index = index + 1;
					var that = $(this),
						link = that.attr('id'),
						navItem = that.parent().find('.mkdf-tabs-nav li:nth-child('+index+') a'),
						navLink = navItem.attr('href');
					
					link = '#'+link;
					
					if(link.indexOf(navLink) > -1) {
						navItem.attr('href',link);
					}
				});
				
				thisTabs.tabs();
				
				$('.mkdf-login-tabs a.mkdf-external-link').unbind('click');
			});
		}
	}

})(jQuery);
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