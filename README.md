# DOCUMENTATION FOR SEE PENNY WORK
### WHAT?
See Penny Work is a kit for creating websites - specifically it was created to visualize bond referendum budgets. It makes it easy to show tax payers where their money is going. But you can use your imagination and use it in other ways, too.

### HOW?
See Penny Work is a Wordpress theme that's connected to a Google spreadsheet. The theme is customized by you so that the style and projects on the sidebar fit with your budget and tastes. Each page gets its information from the input of the creator (like project descriptions and photos), the spreadsheet (like the maps, charts and tables) or through querying tagged items (like documents and related posts). (see fig)

### WHAT YOU'LL NEED TO GET STARTED
If you want to set it up, you'll need someone on hand who understands HTML/CSS and Javascript. But once it's set up, the site is managed through a spreadsheet and Wordpress - easy for all skill levels. 

## TO INSTALL

### INSTALL WORDPRESS 
Install the latest version of Wordpress and follow Wordpress's installation instructions. Once you've installed the file system, you'll download this git repo. Unzip the file once it's downloaded and move that unzipped folder into your Wordpress Themes folder. This is usually at ../wp-content/themes/. Now when you login into the Wordpress (yoursite.com/wp-admin) you'll see this as a theme option. Click Activate to start using this theme.

### USING WORDPRESS WITH HEROKU AND S3
If you don't anticipate high, high traffic, Heroku and Amanzon S3 make great cloud-based solutions for hosting your site. A great tutorial on setting up a Wordpress on Heroku can be found [here]().

### CUSTOMIZE THEME
You'll want to open up the theme files (../wp-content/themes/seepennywork/) in your favorite text editor and customize the colors and project names and categories to fit your project, this can all be done through basic HTML/CSS on the sidebar.php, header.php, footer.php, style.css and so forth. Customize the style to your hearts content.

### CUSTOMIZE JAVASCRIPT AND SPREADSHEETS
Have a look at the [spreadsheets Macon]() is using and see how their information compares to the information you'd like to display. 	 

The javascript may do more than you want it to do so have a look and remove things you don't think you'll need. You may want to write your own functions as well, have at it. The javascript appears on each of the four page templates, you'll want to edit this as well as the functions provided in sheetsee.js.


# THE STRUCTURE
See Penny Work is a Wordpress theme with custom javascript built in. This javascript links the Wordpress pages to a Google Spreadsheet and controls the visualizations.

## COMPONENTS
### Page Templates
1. General pages: such as the about, press and contact pages.
2. Blog: for related current events
3. Category Overviews: For each category
4. Project Pages: For each project
5. Overview: For the entire budget
6. Monthly Revenue: For tax revenue

### Spreadsheet
1. Budget
2. Actuals

## PAGE TEMPLATES

### General Pages
These pages are most like any other Wordpress page. All content is created within the WP CMS interface and no additional customization has been made. 

### Blog
The blog is also very straightforward and all content is created within the WP CMS interface.

**Tagging**
Make sure to tag blog posts with the project name that they relate to, this will list the entry on that project's page.
(see fig. a)

### Category Overview Page Template
First, create a page for each of your Categories.
 
Create a new page in Wordpress. Title the page the name of a Category exactly as you're calling it in your spreadsheets. Select "Category Overview" as your template type. Do not select a page parent. 

Write a description in the text-edit window and publish the page.

### Focus Area Page Template
Create a new page. Title it the Focus Area title exactly as you're using it in your spreadsheet. Select the Focus Area template and the corresponding Parent page. 

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




