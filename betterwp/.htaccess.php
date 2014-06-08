<IfModule mod_rewrite.c>
RewriteEngine On
RewriteBase /
RewriteRule ^dashboard[^/]*$ dashboard/ [R=301,L]
RewriteCond %{QUERY_STRING} (.*)$
RewriteRule ^wp-admin/?$ / [NE,R=404,L]
RewriteCond %{QUERY_STRING} (.*)$
RewriteRule ^wp-admin/(.*)$ dashboard/$1 [QSA,R=301,L,NE]
RewriteCond %{QUERY_STRING} (.*)$
RewriteRule ^dashboard(.*)$ wp-admin$1? [QSA,L,NE]
</IfModule>

# Block the include-only files.
<IfModule mod_rewrite.c>
RewriteEngine On
RewriteBase /
RewriteRule ^wp-admin/includes/ - [F,L]
RewriteRule ^admin/includes/ - [F,L]
RewriteRule ^dashboard/includes/ - [F,L]
RewriteRule !^wp-includes/ - [S=3]
RewriteRule ^wp-includes/[^/]+\.php$ - [F,L]
RewriteRule ^wp-includes/js/tinymce/langs/.+\.php - [F,L]
RewriteRule ^wp-includes/theme-compat/ - [F,L]
</IfModule>
# End Block the include-only files.



##############################
# Default Wordpress Settings #
##############################

# <IfModule mod_rewrite.c>
# RewriteEngine On
# RewriteBase /
# RewriteRule ^index\.php$ - [L]
# RewriteCond %{REQUEST_FILENAME} !-f
# RewriteCond %{REQUEST_FILENAME} !-d
# RewriteRule . /index.php [L]
# </IfModule>
# END WordPress






<ifModule mod_rewrite.c>
RewriteCond %{QUERY_STRING} (\<|%3C).*script.*(\>|%3E) [NC,OR]
RewriteCond %{QUERY_STRING} GLOBALS(=|\[|\%[0-9A-Z]{0,2}) [OR]
RewriteCond %{QUERY_STRING} _REQUEST(=|\[|\%[0-9A-Z]{0,2})
</ifModule>

# Block access to hidden files & directories
<IfModule mod_rewrite.c>
    RewriteCond %{SCRIPT_FILENAME} -d [OR]
    RewriteCond %{SCRIPT_FILENAME} -f
    RewriteRule "(^|/)\." - [F]
</IfModule>

### Block access to source files
<FilesMatch "(^#.*#|\.(bak|config|dist|fla|inc|ini|log|psd|sh|sql|sw[op])|~)$">
    Order allow,deny
    Deny from all
    Satisfy All
</FilesMatch>



<files wp-config.php>
order allow,deny
deny from all
</files>

# SERVER SIGNATURE
ServerSignature Off

# Prevent directory browsing
<IfModule mod_autoindex.c>
  Options -Indexes
</IfModule>

# Prevent this .htaccess
<files .htaccess>
    order allow,deny
    deny from all
</files>


# DENY ACCESS TO PROTECTED SERVER FILES AND FOLDERS
# Files and folders starting with a dot: .htaccess, .htpasswd, .errordocs, .logs
RedirectMatch 403 \.(htaccess|htpasswd|errordocs|logs)$



# REQUEST METHODS FILTERED
RewriteEngine On
RewriteCond %{REQUEST_METHOD} ^(HEAD|TRACE|DELETE|TRACK|DEBUG) [NC]
RewriteRule ^(.*)$ - [F,L]


# TIMTHUMB FORBID RFI and MISC FILE SKIP/BYPASS RULE
# Only Allow Internal File Requests From Your Website
# To Allow Additional Websites Access to a File Use [OR] as shown below.
# RewriteCond %{HTTP_REFERER} ^.*YourWebsite.com.* [OR]
# RewriteCond %{HTTP_REFERER} ^.*AnotherWebsite.com.*
RewriteCond %{QUERY_STRING} ^.*(http|https|ftp)(%3A|:)(%2F|/)(%2F|/)(w){0,3}.?(blogger|picasa|blogspot|tsunami|petapolitik|photobucket|imgur|imageshack|wordpress\.com|img\.youtube|tinypic\.com|upload\.wikimedia|kkc|start-thegame).*$ [NC,OR]
RewriteCond %{THE_REQUEST} ^.*(http|https|ftp)(%3A|:)(%2F|/)(%2F|/)(w){0,3}.?(blogger|picasa|blogspot|tsunami|petapolitik|photobucket|imgur|imageshack|wordpress\.com|img\.youtube|tinypic\.com|upload\.wikimedia|kkc|start-thegame).*$ [NC]
RewriteRule .* index.php [F,L]
RewriteCond %{REQUEST_URI} (timthumb\.php|phpthumb\.php|thumb\.php|thumbs\.php) [NC]
RewriteCond %{HTTP_REFERER} ^.*wpengine.com.*
RewriteRule . - [S=1]

# BEGIN BPSQSE BPS QUERY STRING EXPLOITS
# The libwww-perl User Agent is forbidden - Many bad bots use libwww-perl modules, but some good bots use it too.
# Good sites such as W3C use it for their W3C-LinkChecker. 
# Add or remove user agents temporarily or permanently from the first User Agent filter below.
# If you want a list of bad bots / User Agents to block then scroll to the end of this file.
RewriteCond %{HTTP_USER_AGENT} (havij|libwww-perl|wget|python|nikto|curl|scan|java|winhttp|clshttp|loader) [NC,OR]
RewriteCond %{HTTP_USER_AGENT} (%0A|%0D|%27|%3C|%3E|%00) [NC,OR]
RewriteCond %{HTTP_USER_AGENT} (;|<|>|'|"|\)|\(|%0A|%0D|%22|%27|%28|%3C|%3E|%00).*(libwww-perl|wget|python|nikto|curl|scan|java|winhttp|HTTrack|clshttp|archiver|loader|email|harvest|extract|grab|miner) [NC,OR]
RewriteCond %{THE_REQUEST} \?\ HTTP/ [NC,OR]
RewriteCond %{THE_REQUEST} \/\*\ HTTP/ [NC,OR]
RewriteCond %{THE_REQUEST} etc/passwd [NC,OR]
RewriteCond %{THE_REQUEST} cgi-bin [NC,OR]
RewriteCond %{THE_REQUEST} (%0A|%0D|\\r|\\n) [NC,OR]
RewriteCond %{REQUEST_URI} owssvr\.dll [NC,OR]
RewriteCond %{HTTP_REFERER} (%0A|%0D|%27|%3C|%3E|%00) [NC,OR]
RewriteCond %{HTTP_REFERER} \.opendirviewer\. [NC,OR]
RewriteCond %{HTTP_REFERER} users\.skynet\.be.* [NC,OR]
RewriteCond %{QUERY_STRING} [a-zA-Z0-9_]=http:// [NC,OR]
RewriteCond %{QUERY_STRING} [a-zA-Z0-9_]=(\.\.//?)+ [NC,OR]
RewriteCond %{QUERY_STRING} [a-zA-Z0-9_]=/([a-z0-9_.]//?)+ [NC,OR]
RewriteCond %{QUERY_STRING} \=PHP[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12} [NC,OR]
RewriteCond %{QUERY_STRING} (\.\./|%2e%2e%2f|%2e%2e/|\.\.%2f|%2e\.%2f|%2e\./|\.%2e%2f|\.%2e/) [NC,OR]
RewriteCond %{QUERY_STRING} ftp\: [NC,OR]
RewriteCond %{QUERY_STRING} http\: [NC,OR] 
RewriteCond %{QUERY_STRING} https\: [NC,OR]
RewriteCond %{QUERY_STRING} \=\|w\| [NC,OR]
RewriteCond %{QUERY_STRING} ^(.*)/self/(.*)$ [NC,OR]
RewriteCond %{QUERY_STRING} ^(.*)cPath=http://(.*)$ [NC,OR]
RewriteCond %{QUERY_STRING} (\<|%3C).*script.*(\>|%3E) [NC,OR]
RewriteCond %{QUERY_STRING} (<|%3C)([^s]*s)+cript.*(>|%3E) [NC,OR]
RewriteCond %{QUERY_STRING} (\<|%3C).*embed.*(\>|%3E) [NC,OR]
RewriteCond %{QUERY_STRING} (<|%3C)([^e]*e)+mbed.*(>|%3E) [NC,OR]
RewriteCond %{QUERY_STRING} (\<|%3C).*object.*(\>|%3E) [NC,OR]
RewriteCond %{QUERY_STRING} (<|%3C)([^o]*o)+bject.*(>|%3E) [NC,OR]
RewriteCond %{QUERY_STRING} (\<|%3C).*iframe.*(\>|%3E) [NC,OR]
RewriteCond %{QUERY_STRING} (<|%3C)([^i]*i)+frame.*(>|%3E) [NC,OR] 
RewriteCond %{QUERY_STRING} base64_encode.*\(.*\) [NC,OR]
RewriteCond %{QUERY_STRING} base64_(en|de)code[^(]*\([^)]*\) [NC,OR]
RewriteCond %{QUERY_STRING} GLOBALS(=|\[|\%[0-9A-Z]{0,2}) [OR]
RewriteCond %{QUERY_STRING} _REQUEST(=|\[|\%[0-9A-Z]{0,2}) [OR]
RewriteCond %{QUERY_STRING} ^.*(\(|\)|<|>|%3c|%3e).* [NC,OR]
RewriteCond %{QUERY_STRING} ^.*(\x00|\x04|\x08|\x0d|\x1b|\x20|\x3c|\x3e|\x7f).* [NC,OR]
RewriteCond %{QUERY_STRING} (NULL|OUTFILE|LOAD_FILE) [OR]
RewriteCond %{QUERY_STRING} (\.{1,}/)+(motd|etc|bin) [NC,OR]
RewriteCond %{QUERY_STRING} (localhost|loopback|127\.0\.0\.1) [NC,OR]
RewriteCond %{QUERY_STRING} (<|>|'|%0A|%0D|%27|%3C|%3E|%00) [NC,OR]
RewriteCond %{QUERY_STRING} concat[^\(]*\( [NC,OR]
RewriteCond %{QUERY_STRING} union([^s]*s)+elect [NC,OR]
RewriteCond %{QUERY_STRING} union([^a]*a)+ll([^s]*s)+elect [NC,OR]
RewriteCond %{QUERY_STRING} \-[sdcr].*(allow_url_include|allow_url_fopen|safe_mode|disable_functions|auto_prepend_file) [NC,OR]
RewriteCond %{QUERY_STRING} (;|<|>|'|"|\)|%0A|%0D|%22|%27|%3C|%3E|%00).*(/\*|union|select|insert|drop|delete|update|cast|create|char|convert|alter|declare|order|script|set|md5|benchmark|encode) [NC,OR]
RewriteCond %{QUERY_STRING} (sp_executesql) [NC]
RewriteRule ^(.*)$ - [F,L]
# END BPSQSE BPS QUERY STRING EXPLOITS
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule . /index.php [L]
# WP REWRITE LOOP END

# DENY BROWSER ACCESS TO THESE FILES 
<FilesMatch "^(wp-config\.php|php\.ini|php5\.ini|readme\.html|bb-config\.php)">
Order allow,deny
Deny from all
</FilesMatch>

# FORBID COMMENT SPAMMERS ACCESS TO YOUR wp-comments-post.php FILE
# Searchable Database of known Comment Spammers http://www.stopforumspam.com/

<FilesMatch "^(wp-comments-post\.php)">
Order Allow,Deny
Deny from 46.119.35.
Deny from 46.119.45.
Deny from 91.236.74.
Deny from 93.182.147.
Deny from 93.182.187.
Deny from 94.27.72.
Deny from 94.27.75.
Deny from 94.27.76.
Deny from 193.105.210.
Deny from 195.43.128.
Deny from 198.144.105.
Deny from 199.15.234.
Allow from all
</FilesMatch>

<Files ~ "^.*\.([Hh][Tt][Aa])">
order allow,deny
deny from all
satisfy all
</Files>

# BLOCK HOTLINKING TO IMAGES
# To Test that your Hotlinking protection is working visit http://altlab.com/htaccess_tutorial.html
#RewriteEngine On
#RewriteCond %{HTTP_REFERER} !^https?://(www\.)?example\.com [NC]
#RewriteCond %{HTTP_REFERER} !^$
#RewriteRule .*\.(jpeg|jpg|gif|bmp|png)$ - [F]





# Option 2
# http://www.domain > http://domain

#<IfModule mod_rewrite.c>
    # Options +FollowSymlinks #Not supported by some hosting
    ### If you wish to redirect to a https:// simply substitute http: with https:
    #RewriteCond %{HTTP_HOST} ^www\.(.+)$ [NC]
    #RewriteRule ^ http://%1%{REQUEST_URI} [R=301,L]
    ### Redirect away from /index.php to clear path
    #RewriteCond %{THE_REQUEST} ^.*/index.php  
    #RewriteRule ^(.*)index.php$ http://%{HTTP_HOST}%{REQUEST_URI}$1 [R=301,L] 
#</IfModule>


#######################
# Speed & Compression #
#######################

# BEGIN Expire headers  
<ifModule mod_expires.c>  
    ExpiresActive On  
    ExpiresDefault "access plus 5 seconds"  
    ExpiresByType image/x-icon "access plus 2592000 seconds"  
    ExpiresByType image/jpeg "access plus 2592000 seconds"  
    ExpiresByType image/png "access plus 2592000 seconds"  
    ExpiresByType image/gif "access plus 2592000 seconds"  
    ExpiresByType application/x-shockwave-flash "access plus 2592000 seconds"  
    ExpiresByType text/css "access plus 604800 seconds"  
    ExpiresByType text/javascript "access plus 216000 seconds"  
    ExpiresByType application/javascript "access plus 216000 seconds"  
    ExpiresByType application/x-javascript "access plus 216000 seconds"  
    ExpiresByType text/html "access plus 600 seconds"  
    ExpiresByType application/xhtml+xml "access plus 600 seconds"  
</ifModule>  
# END Expire headers 


<ifModule mod_headers.c>  
    # BEGIN Cache-Control Headers  
    <filesMatch "\.(ico|jpe?g|png|gif|swf)$">  
        Header set Cache-Control "public"  
    </filesMatch>  
    <filesMatch "\.(css)$">  
        Header set Cache-Control "public"  
    </filesMatch>  
    <filesMatch "\.(js)$">  
        Header set Cache-Control "private"  
    </filesMatch>  
    <filesMatch "\.(x?html?|php)$">  
        Header set Cache-Control "private, must-revalidate"  
    </filesMatch>
    # END Cache-Control Headers  
</ifModule>  


<IfModule mod_deflate.c> 
    AddOutputFilterByType DEFLATE text/xhtml text/html text/plain text/xml text/javascript application/x-javascript text/css 
    BrowserMatch ^Mozilla/4 gzip-only-text/html 
    BrowserMatch ^Mozilla/4\.0[678] no-gzip 
    BrowserMatch \bMSIE !no-gzip !gzip-only-text/html 
    SetEnvIfNoCase Request_URI \.(?:gif|jpe?g|png)$ no-gzip dont-vary 
    Header append Vary User-Agent env=!dont-vary 
</IfModule>  

AddOutputFilterByType DEFLATE text/html  
AddOutputFilterByType DEFLATE text/plain  
AddOutputFilterByType DEFLATE text/xml  
AddOutputFilterByType DEFLATE text/css  
AddOutputFilterByType DEFLATE text/javascript  
AddOutputFilterByType DEFLATE application/x-javascript  

#Remove the ETag header
Header unset ETag 
FileETag None  


#######################
# File Format Support #
#######################

### Add support for SVG and HTC
AddType image/svg+xml svg svgz
AddEncoding gzip svgz
AddType text/x-component .htc


########################
# Manual 301 Redirects #
########################

#redirect 301 /old-page-url.html https://www.domain.co.uk/new-page-url


