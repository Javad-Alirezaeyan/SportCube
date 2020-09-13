
<h2>SportCube</h2>

This is a simple task to shows matches 

<h3>Introduction</h3>
You can see the online version here: <a href="http://orderproduct.herokuapp.com/" target="_blank">click here</a>


<hr />
<h4> Technical</h4>  
Used techniques are presented in the following:

Language:
<ul>
<li>PHP 7.2.*</li>
<li>CSS3</li>
<li>JS</li>
<li>HTML5</li>
</ul>

Framework and Library:
<ul>
<li>Laravel version 7.*</li>
</ul>

tools:
<ul>
<li>Docker</li>
<li>Compose</li>
<li>Git</li>
</ul>

Other:
<ul>
<li>PHPUnit</li>
<li>Object orinted</li>
<li>SOLID</li>
</ul>
<hr />

<h3>Better performance</h3> 
Fetching all matches is high loading due to we had to read all pages of API receiving all matches because there is a necessary comparing all matches based on 'globalImportance' and 'kickoftime'. To solve that 
It is better to run a service in the server that fetches the matches of API every minute and saves them into the cache systems.
When a client requests to receive the matches, the server retrieves the matches of the cache and responses to the client.
So the client doesn't have to wait that the server fetches the matches of API.

This solution had been implemented in the source code. You can find it in this URL:


 <hr/>
 
<h3>install</h3> 
 
 1. Clone the source code from github repository. To do that open terminal and type the following command:
  
  <code>
    git clone https://github.com/Javad-Alirezaeyan/SportCube.git
    </code>
          
 2. Then, open the  orderProduct directory with command: 
 
 <code>cd SportCube </code>
  
  and run the following commands  to build nginx, php and laravel project to the containers of docker
    
  <code>
        sudo docker-compose up -d
  </code>
      
 
    
 3. Now, the necessary files and software has been installed on your computer. Type the following code to see container on docker service:
 
 <code>
    docker-compose ps
 </code>
you should see something like the following  text after running the above command:


 
    CONTAINER ID        IMAGE                  COMMAND                  CREATED             STATUS              PORTS                                        NAMES
    0e789a2a1d8d        digitalocean.com/php   "docker-php-entrypoi…"   13 hours ago        Up 13 hours         9000/tcp                                     app
    9cb72d04681c        nginx:alpine           "/docker-entrypoint.…"   13 hours ago        Up 13 hours         0.0.0.0:443->443/tcp, 0.0.0.0:8000->80/tcp   webserver

Product


 4. You can now modify the .env file on the app container to include specific details about your setup.
    
 
 
 As a final step,  visit http://your_server_ip:8000 in the browser. If you install it in local  <a target="_blank" href="http://http://127.0.0.1:8000" > http://127.0.0.1:8000</a>

##screenshots


![alt text](https://github.com/Javad-Alirezaeyan/orderProduct/blob/master/screenshots/6.png)

