/*jslint evil:true */
/**
 * Dynamic thread loader
 *
 * 
 * 
 * 
 * 
 * 
*/

// 
var DISQUS;
if (!DISQUS || typeof DISQUS == 'function') {
    throw "DISQUS object is not initialized";
}
// 

// json_data and default_json django template variables will close
// and re-open javascript comment tags

(function () {
    var jsonData, cookieMessages, session;

    /* */ jsonData = {"forum": {"use_media": true, "avatar_size": 32, "apiKey": "Uu5wSkItFtlCTz2TR3lQ1T0g37WqT4mjOI4EgpBY3wuUqF0hAoostD65ys9C4u1Q", "comment_max_words": 0, "mobile_theme_disabled": false, "is_early_adopter": false, "login_buttons_enabled": true, "streaming_realtime": false, "reply_position": false, "id": 532065, "default_avatar_url": "http://mediacdn.disqus.com/1305240865/images/noavatar32.png", "template": {"mobile": {"url": "http://mediacdn.disqus.com/1305240865/build/themes/newmobile.js", "css": "http://mediacdn.disqus.com/1305240865/build/themes/newmobile.css"}, "url": "http://mediacdn.disqus.com/1305240865/build/themes/t_c4ca4238a0b923820dcc509a6f75849b.js?1", "api": "1.0", "name": "Narcissus", "css": "http://mediacdn.disqus.com/1305240865/build/themes/t_c4ca4238a0b923820dcc509a6f75849b.css?1"}, "max_depth": 0, "lastUpdate": "", "use_old_templates": false, "linkbacks_enabled": false, "allow_anon_votes": true, "revert_new_login_flow": false, "stylesUrl": "http://mediacdn.disqus.com/uploads/styles/53/2065/compassbetadocs.css", "show_avatar": true, "reactions_enabled": false, "disqus_auth_disabled": false, "name": "Compass Documentation", "language": "en", "mentions_enabled": true, "url": "compassbetadocs", "allow_anon_post": true, "thread_votes_disabled": true, "hasCustomStyles": false, "moderate_all": false}, "has_more_reactions": false, "users": {}, "ordered_highlighted": [], "reactions": [], "realtime_enabled": false, "request": {"sort": 4, "is_authenticated": false, "user_type": "anon", "subscribe_on_post": 0, "missing_perm": null, "user_id": null, "remote_domain_name": "", "remote_domain": "", "is_verified": false, "email": "", "profile_url": "", "username": "", "is_global_moderator": false, "sharing": {}, "timestamp": "2011-05-12_21:05:03", "is_moderator": false, "forum": "compassbetadocs", "is_initial_load": true, "display_username": "", "points": null, "moderator_can_edit": false, "is_remote": false, "userkey": "", "page": 1}, "ordered_posts": [], "realtime_paused": false, "posts": {}, "integration": {"receiver_url": "", "hide_user_votes": false, "reply_position": false, "disqus_logo": false}, "highlighted": {}, "thread": {"voters_count": 0, "offset_posts": 0, "slug": "compass_box_sizing_compass_documentation", "paginate": false, "num_pages": 1, "days_alive": 0, "moderate_none": false, "voters": {}, "total_posts": 0, "realtime_paused": true, "queued": false, "pagination_type": "append", "user_vote": null, "likes": 0, "num_posts": 0, "closed": false, "per_page": 0, "id": 173143140, "killed": false, "moderate_all": false}, "reactions_limit": 10, "context": {"use_twitter_signin": true, "use_fb_connect": false, "show_reply": true, "active_switches": ["bespin", "community_icon", "embedapi", "google_auth", "mentions", "new_facebook_auth", "realtime_cached", "show_captcha_on_links", "sigma", "ssl", "static_reply_frame", "static_styles", "statsd_created", "upload_media", "use_rs_paginator"], "sigma_chance": 10, "use_google_signin": false, "switches": {"statsd": false, "disable_realtime": false, "debug_js": false, "google_auth": true, "community_icon": true, "realtime_cached": true, "static_styles": true, "upload_media": true, "addons_ab_test": false, "use_rs_paginator": true, "show_captcha_on_links": true, "statsd_created": true, "bespin": true, "preview_new_theme": false, "new_facebook_auth": true, "frasier": false, "moderate_search": false, "new_thread_create": false, "post_sort_paginator": false, "embedapi": true, "ssl": true, "autocommitted_thread": false, "media_versioned_themes": false, "sexymap": false, "search": false, "post_sort_paginator_index": false, "mentions": true, "sigma": true, "enable_random_recommendations": false, "static_reply_frame": true}, "forum_facebook_key": "", "use_yahoo": false, "subscribed": false, "active_gargoyle_switches": ["show_captcha_on_links"], "realtime_speed": 15000, "use_openid": true}, "ready": true, "mediaembed": [], "reactions_start": 0, "settings": {"uploads_url": "http://media.disqus.com/uploads", "realtime_url": "http://rt.disqus.com/forums/realtime-cached.js", "facebook_app_id": "52254943976", "minify_js": true, "recaptcha_public_key": "6LdKMrwSAAAAAPPLVhQE9LPRW4LUSZb810_iaa8u", "read_only": false, "facebook_api_key": "4aaa6c7038653ad2e4dbeba175a679ba", "debug": false, "disqus_url": "http://disqus.com", "global_message": {"message": "Try this! Mention other people by typing @ then his or her name. Tab to autocomplete. Mentioned people will be notified via email or Twitter.", "expiry": "2011-05-13T00:00:00"}, "media_url": "http://mediacdn.disqus.com/1305240865"}, "media_url": "http://mediacdn.disqus.com/1305240865"}; /* */
    /* */ cookieMessages = {"user_created": null, "post_has_profile": null, "post_twitter": null, "post_not_approved": null}; session = {"url": null, "name": null, "email": null}; /* */

    DISQUS.jsonData = jsonData;
    DISQUS.jsonData.cookie_messages = cookieMessages;
    DISQUS.jsonData.session = session;

    if (DISQUS.useSSL) {
        DISQUS.useSSL(DISQUS.jsonData.settings);
    }
    DISQUS.lang.extend(DISQUS.settings, DISQUS.jsonData.settings);
}());

DISQUS.jsonData.context.csrf_token = '21bc467119200cb06806902fa8e2f5b0';

DISQUS.jsonData.urls = {
    login: 'http://disqus.com/profile/login/',
    logout: 'http://disqus.com/logout/',
    upload_remove: 'http://compassbetadocs.disqus.com/thread/compass_box_sizing_compass_documentation/async_media_remove/',
    request_user_profile: 'http://disqus.com/AnonymousUser/',
    request_user_avatar: 'http://mediacdn.disqus.com/1305240865/images/noavatar92.png',
    verify_email: 'http://disqus.com/verify/',
    remote_settings: 'http://compassbetadocs.disqus.com/_auth/embed/remote_settings/',
    embed_thread: 'http://compassbetadocs.disqus.com/thread.js',
    embed_profile: 'http://disqus.com/embed/profile.js',
    embed_vote: 'http://compassbetadocs.disqus.com/vote.js',
    embed_thread_vote: 'http://compassbetadocs.disqus.com/thread_vote.js',
    embed_thread_share: 'http://compassbetadocs.disqus.com/thread_share.js',
    embed_queueurl: 'http://compassbetadocs.disqus.com/queueurl.js',
    embed_hidereaction: 'http://compassbetadocs.disqus.com/hidereaction.js',
    embed_more_reactions: 'http://compassbetadocs.disqus.com/more_reactions.js',
    embed_subscribe: 'http://compassbetadocs.disqus.com/subscribe.js',
    embed_highlight: 'http://compassbetadocs.disqus.com/highlight.js',
    embed_block: 'http://compassbetadocs.disqus.com/block.js',
    update_moderate_all: 'http://compassbetadocs.disqus.com/update_moderate_all.js',
    update_days_alive: 'http://compassbetadocs.disqus.com/update_days_alive.js',
    show_user_votes: 'http://compassbetadocs.disqus.com/show_user_votes.js',
    forum_view: 'http://compassbetadocs.disqus.com/compass_box_sizing_compass_documentation',
    cnn_saml_try: 'http://disqus.com/saml/cnn/try/',
    realtime: DISQUS.jsonData.settings.realtime_url,
    thread_view: 'http://compassbetadocs.disqus.com/thread/compass_box_sizing_compass_documentation/',
    twitter_connect: DISQUS.jsonData.settings.disqus_url + '/_ax/twitter/begin/',
    yahoo_connect: DISQUS.jsonData.settings.disqus_url + '/_ax/yahoo/begin/',
    openid_connect: DISQUS.jsonData.settings.disqus_url + '/_ax/openid/begin/',
    googleConnect: DISQUS.jsonData.settings.disqus_url + '/_ax/google/begin/',
    community: 'http://compassbetadocs.disqus.com/community.html',
    admin: 'http://compassbetadocs.disqus.com/admin/moderate/',
    moderate: 'http://compassbetadocs.disqus.com/admin/moderate/',
    moderate_threads: 'http://compassbetadocs.disqus.com/admin/moderate-threads/',
    settings: 'http://compassbetadocs.disqus.com/admin/settings/',
    unmerged_profiles: 'http://disqus.com/embed/profile/unmerged_profiles/',

    channels: {
        def:      'http://disqus.com/default.html', /* default channel */
        auth:     'https://secure.disqus.com/embed/login.html',
        tweetbox: 'http://disqus.com/forums/integrations/twitter/tweetbox.html?f=compassbetadocs',
        edit:     'http://compassbetadocs.disqus.com/embed/editcomment.html',

        
        reply:    'http://mediacdn.disqus.com/1305240865/build/system/reply.html',
        upload:   'http://mediacdn.disqus.com/1305240865/build/system/upload.html',
        sso:      'http://mediacdn.disqus.com/1305240865/build/system/sso.html',
        facebook: 'http://mediacdn.disqus.com/1305240865/build/system/facebook.html'
        
    }
};
