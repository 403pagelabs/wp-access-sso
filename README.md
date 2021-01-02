# WP Cloudflare Access SSO: wp-access-sso
A super simple way to allow a single sign on to your Wordpress site when using Cloudflare Access.

**Ideal use case:**
Whitelist (in Cloudflare Access) the email addresses that are allowed access a specific URL (ie. wp-admin/wp-login.php) or an entire site (ie. a corporate intranet). When a user tries to login they'll be sent Cloudflare Access's 6-digit 2FA code. Entering this allows the user to pass through to the Wordpress site.
This plugin sets the user based on the email address sent through a header from Cloudflare Access. 

Upon logging out, a redirect to Cloudflare Access's session terminating URL is triggered.

If no matching email address is found in the database - an error message appears:

```
User not found in site database. Please contact your site administrator for access.
```

**IMPORTANT:**
 - This is not currently recommended on production as it has not been properly security audited.
 - It is **VERY IMPORTANT** that you ensure only requests from Cloudflare IPs (and your server itself) are allowed connect to your Wordpress site when this plugin is activated. You can find the [list of Cloudflare IP Ranges here](https://www.cloudflare.com/en-gb/ips/).

**TO INSTALL:**
Place the `wp-access-sso/wp-access-sso.php` in /wp-content/plugins/ and activate.
There are no settings - it just works.

**QUESTIONS/SUGGESTIONS?**

Github: https://github.com/403pagelabs/fourothree-theme

Twitter: https://twitter.com/403pagedotcom

Instagram: https://www.instagram.com/403pagedotcom/

Email: labs@403page.com

URL: https://403page.com


[![403Page Labs](https://403.ie/wp-content/uploads/2020/11/cropped-New-Project-1-3.png)](https://403page.com)
