# wponlinesupport-assignment
WP Online Support, portfolio plugin

Back-end :
- Create plugin Portfolio
- Create Custom Post Type (Portfolio) with Custom Taxonomy (portfolio cat)
- Custom Post Type contain 2 custom field
       1) Image upload
       2) Text
- Create short-code with following parameter
       - Post Display limit
       - Post feature image display (true/false)

Front-end :
- Display by-default 5 post with featured image and title.
- When click on title or feature image open popup and display post related content
       - Post title
       - Post Content
       - Post custom field data (Image and Text)

== Features ==

- This plugin requires “Advanced custom fields” for text and image
- After installing this plugin, import the ACF field group from the JSON available in “acf-json” folder
- Use short code [wpos-show-portfolio] to add the custom posts to any page
- “display-image” parameter can be used with values 0 or 1 to turn on/off display of featured image on the front end
- “limit” parameter can be used with the short code for limiting the display of posts on the front end
- eg: [wpos-show-portfolio limit=10 isplay-image=0]
