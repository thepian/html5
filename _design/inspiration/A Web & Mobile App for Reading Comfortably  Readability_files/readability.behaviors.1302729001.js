/*
 * Readability.Behaviors.Js
 *
 * @Authors: Daniel Lacy <daniell@arc90.com>, Philip Forget <philipf@arc90.com>
*/
var readability = typeof(readability) === "undefined" ? {} : readability;

var decrElement = function ($elems) {
    $elems.each(function() {
        var $elem = $(this),
            num = parseInt($elem.text().replace(/[^\d]/g, ''), 10);

        return $elem.text(num - 1);       
    });
};


var incrElement = function ($elems) {
    $elems.each(function() {
        var $elem = $(this),
            num = parseInt($elem.text().replace(/[^\d]/g, ''), 10);

        return $elem.text(num + 1);
    });
};


var ArchiveToggle = function ($toggleLink) {
    var url         = $toggleLink.attr("href"),
        articleID   = $toggleLink.attr("data-article-id") || articleId,
        $article    = $('#article-' + articleID),
        init_value  = $toggleLink.attr("data-value") == "1" ? true : false,
        value       = init_value;

    function set_value (new_value) {
        if(value != new_value){
            value = new_value;
            $toggleLink.attr("data-value", value ? 1 : 0);
            if(!$('body').is('.favorites')) {
                if(value != init_value) {
                    $article.stop().fadeTo(250, 0).slideUp();
                }
                else {
                    $article.stop().animate({"opacity": "1"}, 350);
                }
            } else {
                if(new_value) { //unarchive to archive
                  $article.find('.article-archive').text('Unarchive');
                } else {
                  $article.find('.article-archive').text('Archive');
                }
            }

            if(value === true) {
                decrElement($('#sect-nav-queue span.count'));
                incrElement($('#sect-nav-archive span.count'));                         
            } else {
                decrElement($('#sect-nav-archive span.count'));
                incrElement($('#sect-nav-queue span.count'));
            }
        }
    }

    $toggleLink.click(function(event){
        event.preventDefault();
        readability.toggleBooleanField({
            url: url,
            callback: function(data){
                if(!data.success){
                    set_value(init_value);
                }
                readability.invalidateCache();
            }
        });
        set_value(!value);
        
        return false;
    });
};


var FavoriteToggle = function($toggleLink){
    var url         = $toggleLink.attr("href"),
        articleID   = $toggleLink.attr("data-article-id") || articleId,
        $article    = $('#article-' + articleID),
        init_value  = $toggleLink.attr("data-value") == "1" ? true : false,
        value       = init_value;

    function set_value(new_value){
        if(value != new_value){
            value = new_value;
            $toggleLink.toggleClass('active', value);
            if(value) {
                incrElement($('#sect-nav-favorite span.count'));                            
            } else {
                decrElement($('#sect-nav-favorite span.count'));
            }
        }
    }

    $toggleLink.click(function(event){
        event.preventDefault();
        readability.toggleBooleanField({
            url: url,
            callback: function(data){
                if(!data.success){
                    set_value(init_value);
                }
                readability.invalidateCache();
            }
        });
        set_value(!value);
    });
};


$(function(){

    // TODO: I'm not sure this is the greatest idea, what if I just want to select my content tag, or a part of this?
    $('input.copy-paste, textarea.copy-paste').click(function(){
        $(this).focus().select();
    });

    /* Readonly messes with iOS' ability to select text, so remove it for them. */
    if($.browser.ipad || $.browser.iphone) {
        $('input.copy-paste, textarea.copy-paste').removeAttr('readonly');
    }

    $('.article-favorite').each(function() {
        favoriteToggle = new FavoriteToggle($(this));
    });

    $('.article-archive').each(function(){ 
        archiveToggle = new ArchiveToggle($(this));
    });

    $('#rdb-reading-list > li').each(function() {
        var $article  = $(this),
            articleId = $article.attr('data-article-id'),
            articleUrl = "/articles/" + articleId + "/";
        
        $(this).find('a[href="' + articleUrl + '"]').click(function() {
            $article.addClass('clicked');
            return true;
        });
    });

    $('.article-confirmDelete').live('click', function(e) {
        e.preventDefault();

        var articleItem = $(this),
            articleId   = articleItem.attr("data-article-id"),
            articleTitle = articleItem.parents('li').find("span.source").text();

        readability.UI.displayWarning(articleId, 
            '<p class="confirm-delete">Are you sure you want to remove this article?<span>*</span></p>' +
                '<p><a href="#" class="article-remove button-negative" data-article-action="remove" data-article-id="' + articleId + '">Delete It</a>' +
                ' or <a href="#" class="main-link cancel-warning">Cancel</a></p>' +
            '<p class="hint">*Deleting will remove this contribution to ' + articleTitle + '.</p>'
            );

    });

    $('a.article-remove').live('click', function() {
        var articleId = articleId ? articleId : $(this).attr('data-article-id'),
            $link     = $(this);
        
        $.post('/articles/' + articleId + '/ajax/remove/', {}, function (responseObj) {
            if(responseObj.success) {

                if ($('body').hasClass('favorites')) {
                    decrElement($('#sect-nav-favorite span.count'));

                } else if ($('body').hasClass('archives')) {
                    decrElement($('#sect-nav-archive span.count'));

                } else if ($('body').hasClass('latest') && $('#article-' + articleId).find('.article-favorite.active').length > 0) {
                    decrElement($('#sect-nav-favorite span.count'));
                    decrElement($('#sect-nav-queue span.count'));

                } else {
                    decrElement($('#sect-nav-queue span.count'));

                }
                $('#article-' + articleId).fadeTo(250, 0).slideUp();

            } else {
                readability.UI.displayWarning(articleId, '<p>Sorry, there was a problem removing this article. Please contact Readability support. (Article ID: ' + articleId + ')</p>');

            }

            readability.invalidateCache();
        }, 'json');
    
        return false;
    });
    
    $('a.article-add').click(function(e){

        if ($(this).is('.added')) {
            return false;
        }

        var article_link = $(this),
            cached_link  = article_link.clone(),
            added_text   = 'Added to Reading List',
            error_text   = 'There was an error adding the article, please try again later.',
            ajax_href    = article_link.attr('href');

        article_link.html("Adding&hellip;");

        $.post(ajax_href, {}, function(data) {
            if (data.success) {
                article_link.addClass('added').attr({title: added_text, 'data-value' : 1}).text(added_text);   

            } else {
                if (typeof data.duplicate != "undefined" && data.duplicate) {
                    article_link.addClass('added').attr({title: added_text, 'data-value' : 1}).text(added_text);

                } else {
                    article_link.html(error_text);

                    setTimeout((function(article_link) {
                        return function() {
                            article_link.fadeOut(500, function(){
                                article_link.remove();   
                            });
                        };
                    }(article_link)), 2000);

                    article_link.after(cached_link);
                }
            }

            readability.invalidateCache();

        }, 'json');
        
        return false;
    });

    // Hide all warning messages on dismiss.
    $('.cancel-warning').live('click', function(e) {
        e.preventDefault();
        $(".warning").fadeOut();
    });

    // Sidebar tools
    
    $("#tool-print").click(function(e){
        e.preventDefault();
        window.print();
    });

    /* Appearance ajax settings - both in the appearance control panel and article view. */

    $('#dropdown-appearance input:radio').click(function(event){
        event.stopImmediatePropagation();
        var $elem = $(this),
            property = $elem.attr("name"),
            value = $elem.attr("value"),
            previous_value = readability.BodyClass.getClassByRegex(new RegExp("^" + value.split("-")[0]+"-"));

        if(previous_value != value){
            
            if($('body').is('#article')) {
                readability.BodyClass.addRemove(value, previous_value);             
            }

            // Set the body class right away
            readability.setAppearanceValue(
                "appearance",
                property,
                value,
                function(data){
                    if( data.success ){
                        readability.invalidateCache();
                    }
                    else {
                        readability.dbg("Unable to save appearance preferences");
                    }
                }
            );
        }
    });

    $('#dropdown-appearance input:checkbox').click(function(event){
        event.stopImmediatePropagation();
        var $elem = $(this),
            property = $elem.attr("name"),
            value = $elem.attr("checked") ? true : false;

        if($('body').is('#article')) {
            if( value ){
                readability.BodyClass.add(property);
            }
            else {
                readability.BodyClass.remove(property);
            }           
        }

        readability.setAppearanceValue(
            "appearance",
            property,
            value,
            function(data){
                if( data.success ){
                    readability.invalidateCache();
                }
                else {
                    readability.dbg("Unable to save appearance preferences");
                }
            }
        );
    });
    
    // Keep track of any id_subscription_ammount fields for change and update the corresponding fields
    $('#id_subscription_amount').each(function(){
        var $notice       = $('#contribution_notice'),
            $notice_error = $('#contribution_notice_error'),
            $amount_field = $('#contribution_amount'),
            $submit       = $('#registration_submit');

        function amount_validator(){
            var amount  = (parseFloat($(this).val()));
            if( isNaN(amount) || amount < 5 ){
                $notice.hide();
                $notice_error.show();
            }
            else {
                $notice.show();
                $notice_error.hide();
                $amount_field.text((amount * 0.7).toFixed(2));
            }
        }

        $(this).keyup(amount_validator);
        amount_validator.call($(this));
    });
});
