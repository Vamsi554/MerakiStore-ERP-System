# Web Security 

1. Security is defined as the state of being protected or safe from harm.

2. Web Security means keeping your web server, and it's applications protected or safe from harm. Websites require special attention. They're public, high-profile and often represent brand of the company and in some cases like Amazon, the company itself.

3. In order to protect the websites from security issues, we need to understand the potential pitfalls and threats that the application might encounter.

4. We need to know who would attack us and how would they do it. Once we've surveyed the potential problems, we need to come up with required measures to ensure safety of information. Awareness + Protection = Security.

# General Security Principles

# Least Privilege

1. The principle of least privilege says that every program and every privileged user of the system should operate using the least amount of privilege necessary to complete the job.

2. The principle of least privilege means giving a user account only those privileges which are essential to that user's work and nothing more. 

3. And a user with limited privileges, certainly, shouldn't be able to edit their own user privileges. Code has access privileges too. Code should be limited in what it exposes and what it accesses. 

4. The benefits of the principle of least privilege are that you'll have more code stability, because you'll be able to control the access to data. 

5. It'll make it easier to test actions and interactions between different parts of your code. It will also increase your system security because any vulnerabilities that you have are going to be limited and localized. 

6. For example, if a low-level user has their password compromised, you don't have to worry that the entire system is compromised. Only the areas to which that user had access are a concern. What could be a nightmare scenario suddenly becomes a small problem that can be solved quickly.

# Simple is more secure

1. The larger and more complex that a system becomes the harder it becomes to secure. Larger systems have more areas of concern. More complex systems increase the likelihood of bugs or of making mistakes. Simpler is always more secure.

2. When programming, there are several techniques that you can use to reduce complexity and therefore, increase security. You can use clearly named functions and variables. You can write code comments. 

3. A lot of times security concerns have been taken into account in the built-in versions and you might not take those same precautions in your own. And in the same way that you shouldn't leave legacy code lying around, you'll also want to disable or remove unused features whenever possible. 

4. If you're loading a code library but you aren't using it, it should be considered a security liability and removed. If a web server won't be sending emails, then disable or remove all email sending features. If a web server, won't be allowing FTP access, then disable or remove FTP access.

5. Turn off any Apache modules that you don't need. You don't need to have PHP if you're not using PHP. You could then be open to a variety of PHP vulnerabilities. To go back to the house metaphor that we started with. What's safer than shutting and locking a door? Well it's removing the door all together. So you want to keep this key security principle in mind. Simple is always more secure.

# Never Trust Users

1. Trust everyone only as far as you must. But it goes beyond just assigning access privileges.

# Always expect the unexpected

1. Security is not like chess where we act upon some one else's moves. We need to be proactive, assume that we're hacked and figure things out what will happen ahead of time.

2. We need to prevent the crime before it happens.

# Defense in Depth

1. This means writing a security policy, getting everyone educated, getting them to follow best practices, and assigning responsibilities to them. 

2. The second area is technology. Now when we talk about technology we're talking about having security throughout your entire technology stack. That is, hardware, software, acquisition and maintenance, the system administration, as well as the programming that you do. 

3. It touches on firewalls, intrusion detection, server hardware and software, whether it's the web server, the web application, technologies that you're using, or your database, encryption to protect your data while it's in transit, as well as having good access controls to servers and to data in place.

4. Typically your server, your web application, and your databases all require user names and passwords. That means they all have the built-in ability for access control. And the third is operations. This mean periodic security reviews, data handling procedures, monitoring responsibilities and how do you respond to threats.  















