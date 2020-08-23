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

            * Architecture: Model-View-Controller Design Pattern
            
            * Web Server: Apache Server
            
            * Operating System: Linux
            
            * Front End: HTML, CSS, JavaScript, JQuery, AJAX, 
                         Bootstrap, Laravel Blades
            
            * Back End: PHP, Laravel Framework
            
            * Database: MySQL                                                                                                  

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

# Go Through the [System Operations PDF](Meraki_Stores.ERP_System_Operations.pdf) Document For More Details!
