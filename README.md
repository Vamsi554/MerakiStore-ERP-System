## MerakiStore_ERPSystem

![MERAKI](https://user-images.githubusercontent.com/34600966/55279614-73f59f00-5340-11e9-934a-303fc524515a.png)

## Meraki Stores ERP System Design

# Introduction

1.ERP application has been designed and developed for Meraki Stores to handle its business orders efficiently.

2.The main aim of the system is to bring the existing workflow processing system online and store information efficiently and securely.

3.This can be used later for reviewing, tracking and analyzing the business model further for better customer experience.

4.Frequent terminology encountered during the lifecycle processing includes Enquiry, Enquiry Requirements, Enquiry Quotations, Order, Purchase Order, Tech Pack, Proforma Invoice, Advance Payments, Full Payments, Vendor Payments, Delivery Challan, Tax Invoice.

5.Enquiry will be created in the system whenever any order is to be taken up. All the details required are captured as part of enquiry requirements.

6.Once all requirements are received, quotation price details are entered into the system and quotations are generated. There might be chances of generating the revised quotations too at times.

7.Once a quotation is accepted, order is created on top of quoted price and customer is confirmed with on the order details.

8.Then purchase order to the respective vendor is created and order is confirmed to the production.

9.Production team will give frequent updates and details about order delivery.

10.Finally, the order is delivered to the customer.

11.The application automates the entire order processing stages, stores all the information and displays when required in future.

12.Analytics will also be done on the data and can be useful for making important decisions.

# Current System

1.Currently at Meraki, Order processing is done manually by the team. 

2.Traditional file-based data storage approach is used where information is captured in Word documents, Excel sheets, Google sheets etc.

3.This is consuming lots of manual efforts and at times error prone too.

4.To avoid these situations and overcome manual efforts, highly secured web application has been designed which brings the entire system online and provides an efficient way of handling enquiries and orders and better tracking of order status at respective stages in the order lifecycle.

5.All the manually done documents such as quotations, proforma invoice, payment receipts, tech pack, delivery challan, tax invoices, purchase orders are generated online now and efficiently without any errors.

6.The web application completely minimizes the manual efforts and provides great reliability and source of information for future orders and allows people to focus more on business to get more orders.

7.Moreover, all the information can be reviewed and cross checked at a later point of time for making business critical decisions.

# Functional Description

1.Full Requirements for Meraki Stores ERP Web Application.

2.The entire data for Meraki Stores ERP suite can be categorized under two sections.

3.The Primary section is referred to as the Master Data which the system needs before proceeding with any orders. 

4.Primary data refers to the Product Catalog Features and Customizations Details, Vendor Details in the system, Users of the ERP 
application.

5.The other kind of data is the transactional data which gets accumulated every day specific to enquiry or order detailing.

6.Following are the high-level set of terminologies encountered during the order processing and each one of them have their own lifecycle.

      o	Enquiry
      o	Enquiry Requirements
      o	Quotations
      o	Orders
      o	Admin Orders
      o	Production Orders
      o	Purchase Orders
      o	Product Catalog Suite
      o	Vendor Management
      o	User Management
      o	Task Management


7.Following are the set of documents that are expected by the system to generate once all relevant information is filled in by the user.

      o	Quotations
      o	Revised Quotations
      o	Proforma Invoice
      o	Tech Pack
      o	Customer Payment Receipt
      o	Purchase Order
      o	Delivery Challan
      o	Tax Invoice

# User Community Description

1.Sales Team, Admin Team and Production Team are the set of users interacting with the system to add/update/retrieve information in the system.

2.Initially sales team and admin team are the set of users responsible for interacting with the system and come up with any changes and later on will be extended to wide variety of users.

3.Admin can any time add a user, update user details, delete user from the system and can perform all variety of actions.

4.Users won’t be deleted permanently from the system. Once a user has been removed from the list by the admin, they would have the last date enabled and the details would be moved to a separate schema. 

5.This is just to have a track of all the users who worked on the ERP application and their basic details and portfolio.

# Technical Architecture

1.The ERP application is a custom-built web-based application which tracks the different stages of order lifecycle at Meraki Stores.

2.The current ERP web application is based on Online Transactional Processing approach.

3.Major application components include Enquiries, Orders, Admin Orders, Purchase Orders, Product Catalogs, Vendors, Quotations, Invoices, Delivery Challans and few other documents indicating the merchandise details.

4.It’s a three-tier Model View Controller architecture approach.

5.Models represent the objects that interact with the relational databases.

6.Views represent the user interface part of the application.

7.Controller performs the necessary actions as per the requests and performs database add, update, routing and re-directing activities.

8.The following table details the technical stack for the ERP application. (LAMP Stack)

# Technology Stack

            Architecture   	                 Model-View-Controller Design Pattern
            Web Server    	                 Apache Server
            Operating System	                Linux
            Front End	                         HTML, CSS, JavaScript, JQuery, AJAX, Bootstrap, Laravel Blades
            Back End	                         PHP, Laravel Framework
            Database	                         MySQL 
                                                                                                                         

1.The system collects and manages the everyday data related to the orders/enquiries and presents to the user when required.

2.The application brings a lot of flexibility in using and maintenance of system. All the business activities, everyday tasks, user management is being handled by the system.

3.The system has a browser-based web interface where users would be interacting every day.

4.The web application is hosted on the Go Daddy Domain (www.erp.meraki.store)

5.Maintenance of the current system involves a set of activities to be done at periodic intervals of time. They’ve been documented under a separate heading.

# Security Considerations

1.Security is a must for any web application now-a-days and ERP application must be very much secure since it stores all the business sensitive data and can’t be compromised on this.

# Modes of Operation

1.ERP application is a critical application to a business as it manages day to day activities in a business and operations must be handled very carefully.

2.We will be having two different environments for the system. 

      o	Development Environment
      o	Production Environment

3.Development environment is for daily development and testing purposes a developer needs and first level entry for testing the new code in the application.

4.Production Instance is the final one which the team at Meraki Stores would be using daily.

5.Every day application data backups and database backups are to be done and saved to some location.

6.These backups are very much necessary and failure to do so will have a great chance of havoc in case if there are any issues and production systems doesn’t respond.

7.Emergency data recovery activities would be conducted once in every two months to cross verify whether we’re able to recover all the data using the latest backup files and issues faced during these stages must be well documented and noted for the future use.

# Maintenance Activities

1.Implementing a proper maintenance schedule ensures your site will continue to work for you as one of your most valuable tools.

2.ERP application is mostly related to business and various activities undergoing in the business and maintenance plays a critical role because this is very different from a normal website which would be done for digital marketing.

3.Proper and regular maintenance of the application is needed as data grows day to day in these kinds of applications and to be maintained effectively.

4.As the data grows, performance issues might occur in few pages, pages take more time to load etc., 

5.Developer needs to document down all the issues and work on them for a better user experience and ensuring that no data or web page is broken.

6.As part of maintenance activity, the overall responsibility of updating and operating the site is being taken care by the support team so that people working under different user community groups such as sales, marketing, admin and other teams can focus on what’s important to them.

7.Designing an ERP application from scratch for a startup is not a onetime activity. As the data grows and people start using it, there might be situations where business logic needs to be changed, pages to be reworked and new features might get added etc.,

8.Maintaining the overall functionality of the website ensuring that pages doesn’t crash and even though there might be some errors in the page, the logs shouldn’t reveal any sensitive information.

9.As requirements arise, new pages need to be developed and logic needs to be written. Existing code might also to be reworked at times 
during the maintenance phase. 

10.Ensuring that there are no broken links on the site.

11.Advising on how to use the application and grow the site effectively.

12.Daily or Weekly backups are to be taken as part of disaster management activities.

13.Development of codes needs to take place to achieve automatic data backup and send an email to relevant users will all the details.

14.Data restoration would be done as and when required.

15.Monthly reports are to be prepared and analyzed which includes errors such as broken links, server errors, timeout errors, empty titles, duplicate titles and other kind of errors that the team might face while using the web application.

16.Other activities can be categorized as follows. We need to ensure the following.

# Weekly Tasks

1.All the pages on the web application are loading without any errors.

2.Application and Database backups are to be performed regularly and stored off site.

3.Update core software in case of any adhoc requests or if any issues needs to be handled.

4.Ensuring that all the forms on the page are working correctly.

5.Check for broken links.

6.Check for 404 errors and resolve these by fixing links or redirecting.

# Monthly Tasks

1.Check for website loading speed. Performance is one of the critical factors we have as part of this web application. Data is increased every day as more orders needs to be entered into the system and sometimes loading all the data and wait till the page gets loaded often gets irritation among the users as they’ll have to wait for the same. Necessary decisions need to be taken by the team to handle this.

2.Performing security scans and resolve if any issues are identified.

3.Perform data analytics and derive some visual representations out of it which will be very helpful in making business decisions.

4.Introducing the emailing feature and developing the same periodically.

# Quarterly Tasks

1.Review the entire ERP application and find out what could be improved and what areas needs to be worked on newly.

2.Review the product catalog features and other master data content on the site.

3.Review and tweak meta title and meta description tags.

4.Noting down the activities that needs to be performed manually and thinking of ways to automate them without any errors.

5.Testing the website to ensure that it looks and displays properly on most popular browsers.

6.Periodically checking the backup logs and performing emergency web application recovery activities.

# Yearly Tasks

1.Review each page on the site for content accuracy.

2.Renew the web application domain name. Ensure that contact information on Go Daddy is correct.

3.Review whether the ERP application is in align with your business goals.

4.Consider updating the website design, layouts for a better user experience.

