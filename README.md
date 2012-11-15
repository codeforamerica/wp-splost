# HI!
# Documentation for See Penny Work
### What?
[See Penny Work](http://www.seepennywork.in) is a kit for creating a data-powered website - specifically it was created to visualize bond referendum budgets. More specifically, it was created for Macon, Georgia during it's 2012 partnership with [Code for America](http://www.codeforamerica.org). It makes it easy to show tax payers where their money is going. But you can use your imagination and use it in other ways, too.

### How?
See Penny Work is a Wordpress theme that's connected to Google spreadsheets. The theme is customized by you so that the style and projects on the sidebar fit with your budget and tastes. Each page gets its information from the input of the creator (like project descriptions and photos), the spreadsheets (like the maps, charts and tables) or through querying tagged items (like documents and related posts). More details on this futher on.
![spreadsheet publish settings](https://raw.github.com/codeforamerica/wp-splost/master/readme-imgs/content-sources.png)

### What You'll Need to get Started
If you want to set it up, you'll need someone on hand who understands HTML/CSS and Javascript. But once it's set up, the site is managed through a spreadsheet and Wordpress - easy for all skill levels. 

# Set it Up

### Install Wordpress
Install the latest version of Wordpress and follow Wordpress's installation instructions. Once you've installed the file system, you'll download [this git repo](https://github.com/codeforamerica/wp-splost), which is the theme. Unzip the file and move that unzipped folder into your Wordpress Themes folder. This is usually at `../wp-content/themes/`. Now when you login into the Wordpress (`yoursite.com/wp-admin`) you'll see this as a theme option. Click *Activate* to start using this theme.

### Using Wordpress with Heroku and S3
If you don't anticipate high, high traffic, Heroku and Amanzon S3 make great free and cheap cloud-based solutions for hosting your site. Two great tutorials on setting up a Wordpress:
* [Migrating Wordpress Blog to Heroku](blog.pardner.com/2012/04/migrating-a-wordpress-blog-to-heroku/) by Parner Wynn
* [Running Wordpress on Heroku](http://www.mick.im/2012/05/26/wordpress-heroku/) by CfA Alum [Mick Thompson](https://twitter.com/dthompson/)

### Customize Theme
You'll want to open up the theme files (`../wp-content/themes/wp-splost/`) in your favorite text editor and customize the colors and project names and categories to fit your project, this can all be done through basic HTML/CSS with the `sidebar.php`, `header.php`, `footer.php`, `style.css` files and so forth. Customize the style to your heart's content. Match your Category colors in your style.css and hexcolor column in the spreadsheet.

![match colors](https://github.com/codeforamerica/wp-splost/raw/master/readme-imgs/colors.png)

### Customize Spreadsheet and Javascript
Have a look at the [spreadsheets Macon](https://docs.google.com/a/codeforamerica.org/spreadsheet/ccc?key=0Aj3c4mZCQQaMdGE2TVphOWlXMUMyclRXa2Z1c0g5MGc#gid=1) is using and see how their information compares to the information you'd like to present. 	

Link your spreadsheet to your Wordpress by opening your spreadsheet, clicking File > Publish to the Web and setting the window like so: 
![spreadsheet publish settings](https://github.com/codeforamerica/wp-splost/raw/master/readme-imgs/publish-spreadsheet.png)

When it generates the URL in the bottom text box, you'll copy that URL and paste it into the URL variable at the top of `sheetsee.js`.
![set spreadsheet url](https://github.com/codeforamerica/wp-splost/raw/master/readme-imgs/sheetsee-url.png)

## Sheetsee.js
`Sheetsee.js` contains most of the javascript that filters the spreadsheet data and generates the charts, maps and tables. It is used on each of the project and overview templates. It may do more or less than you'll need for your budget. You'll want to have someone who is famailiar with Javascript go through it, take out parts you don't need and possibly create more to suit your unique needs.

Once your spreadsheet is linked to your Wordpress instance you're ready to start setting up the pages.


# The Structure
See Penny Work is a Wordpress theme that interacts with other elements of the site (such as blog posts) as well as making use of Javascript on each page to connect to your spreadsheet and generate the visualizations. 

For reference, the diagram below explains the basic layout of pages and what I call those parts.
![page structure](https://raw.github.com/codeforamerica/wp-splost/master/readme-imgs/page-structure.png)

## Componets

### Sidebar
The side bar, which is custimized by you through HTML/CSS, illustrates the structure of the budget which is Categories and their Focus Areas. Inside each Focus Area page, projects are listed. Projects are the itemized elements from the revenue spreadsheet.

### Sub Nav
These are created using default Wordpress templates and can links can be customized in the `header.php` file.

The pages that do not use templates and use Wordpress Defaults:
1. General pages: such as the about, press and contact pages; No template.
2. Blog: for related current events; no template.

### General Pages, Blog
These pages are like any other basic Wordpress page. All content is created within the Wordpress CMS interface and no additional customization has been made. 

**Tagging**
Make sure to tag blog posts with the Focus Area name that they relate to, this will list the entry on that Focus Area's page.


### Breadcrumbs
This lets the user know where they are within the site. The `header.php` file contains the PHP that customizes this.

### Title
Set your title in the `header.php` file.

### Footer
You'll most likely want to customize the two left most sections of the footer, do so with `footer.php`.

### Main Content
Main content is the heart of the project and different depending on the page you're on. The following will describe in detail. 

### Page Templates
There are four page templates:

1. **Category Overviews**: For each category; Category Template.
2. **Focus Area Pages**: For each Focus Area; Focus Area Template.
3. **Overview**: For the entire budget and all projects; Overview Template.
3. **Monthly Revenue**: For tax revenue each month; Revenue Template.

These templates connect the *main content* to the spreadsheets and fill the page with visuals.

![site connecting to spreadsheets](https://github.com/codeforamerica/wp-splost/raw/master/readme-imgs/spreadsheet-threads.png)

### Spreadsheet
1. **Budget**, nice round numbers, lat and long, colors - stays mostly static
2. **Actuals**, itemization of expenditures (called Projects) and revenue - updated each month

Generally, a page template has content sources like this:
![site content sources](https://raw.github.com/codeforamerica/wp-splost/master/readme-imgs/content-sources.png)


## Page Template Use

### Category Overview Page Template
First, create a page for each of your Categories.
 
To do so, create a new page in Wordpress. Title the page the name of a Category *exactly* as you're using it in your spreadsheets. Select "Category Overview" as your template type. Do not select a page parent. 

Write a description in the text-edit window and publish the page.

### Focus Area Page Template
Create a new page. Title it the Focus Area *exactly* as you're using it in your spreadsheet. Select the Focus Area template and the corresponding Category as the Parent page. 

In the text-area, write a brief paragraph describing the project. 

**Photos**
Add photos using Wordpress's Gallery option. To add photos, click the Upload/Insert media button above the text-area. Add the photos in the drag and drop section and then select Save Changes. In the Gallery tab, select Insert Gallery. Publish page. The page template knows to take this gallery and place it at the bottom. The Gallery option nicely formats the images into thumbnails which visitors can click on to see larger versions or more in the gallery. The template will also add singular images to the bottom of the page.

**Featured Photo**
This is the photo that appears cropped at the top of a page. To add this photo, on the righthand side of your page select 'Set Featured Image.' Drag and drop the image you'd like into the boxed area. Select 'Make Featured Image' and then click 'Ok'. This designates that photo as the featured image and adds it to the gallery. I recommend using an image you've cropped to 780x150 pixels so that you do not fill up valuable space on the screen.

**Maps and Charts**
The page's maps and charts are generated from the data you've created and connected to in the spreadsheets.

### Overview Page Template
This template serves just one page, the Overview page, which displays information about all of the projects within your budget. 

Create a page, give it a parent that matches the name of your project and select the Overview template. Write a description of the entire budget and projects and click Publish.

### Montly Revenue Page Template
This page can be used to display the budgeted and actual numbers regarding revenue from the sales tax. It uses the Monthly Revenue template.

# What else?

### Other Plans
My fellowship is now over and my time will get focused elsewhere, but I still love and care about this project so expect that in my free time here and there I'll be cleaning up the code and making a more general theme file (versus this one which is exactly customized to Macon). I'm also hoping to round out sheetsee.js in a more general-use kind of way.

### Contact
I'm Jessica Lord: [jessica@codeforamerica.org](mailto:jessica@codeforamerica.org) and [@jllord](http://www.twitter.com/jllord).





