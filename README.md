# Shopify-app-with-native-php
In this template i use native php to create a shopify app exemple that use yhe product API

# REQUIREMENT

You've created a Partner account and a development store.

You've created a app on your shopify partner

You've installed Node.js 14.13.1 or higher.

You've installed a Node.js package manager: either npm, Yarn 1.x, or pnpm.

You've installed Git.

You're using the latest version of Chrome or Firefox.
https://shopify.dev/apps/getting-started/create#:~:text=You%27ve%20created%20a,Chrome%20or%20Firefox.

# HOW TO USE IT ?

Before all Donwload the repository by downloading in zip file or unse git cli to clone 
first start by using "gem install win32-open3"
i think you have install Ruby and gem command. Once you have do that you can use gem command. If not you can download ruby easily
After this use the commande *gh repo clone Mendel-Chodaton/Shopify-app-with-native-php* ton install the repository

1- Edit /inc/mysql_connect.php

mysql_connect.php will allow us to connect your database to your project and call information in the database, To your the shopify app's code. But before you need to change the file like this 

Be sure to pass your database imformation values

Your databse username
Your dtabase password
Your database name


2- Install.php

Install php code file will allow you to build your installation link. This code is realy important and help merchant to install your app and be redirect to the index where there can use the app feature

Your api Key ===> pass your api key from your shopify app setup.

Your shopify secret key ===> pass your shopify secret key from your shopify app setup.

Your Path to generate_token.php code file.
Ex www.example.com/generate_token.php.


3- Generate_token.php

This code will generate api token that will help you to use the shopify API and store it in the database you have listed in the mysqli_connect.php code.
After create your token and store it in your database you will be redirect on the app index.
But before be sure to edit this values and change them.

Where "$api_key" change the value to your shopify api key from your shopify app setup. 
Where "$shared_secret" change the value to your shopify secret key from your shopify app setup.

Where "$sql = "INSERT INTO shops (shop_url, access_token, install_date) VALUES ('" . $params['shop'] . "','". $access_token ."',NOW())";" 'shops' are the name of the table where we collect our information. In your case you need to put the name of the table you have create and wnat to collect your informations.

Where 'price' in different array ? put the price you want to sell you app.

Where 'return url' you need to finish the link with your app name


4- Index.php

In $sql where 'shops' change and pass the table name where are stored collected information.
In $array where 'PATH_TO' change and passe the project url to the the folder you want to charge your code.
Example if your 'DOMAIN_URL_PROJECT_PATH' are stored at 'webhooks/create.php' and you have www.example.com/webhooks/create.php ? chnge the https://PATH_TO by https://www.example.com.

In this code we have call and used the shopify product API. You need the shopify access token and rhe store name to be able to use the API. With the code we have ever collected all this information but you will need to make changes i mention to collect that on your database's table. Then you can call it.




