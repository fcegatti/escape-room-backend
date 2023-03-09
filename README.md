# Escape Room 404 - Factoría F5
![Escape Room 404](./src/assets/logotype/logo404.svg)
![Factoría F5](src/assets/logotype/logo-factoria.png)
![Factoría F5](src/assets/logotype/factoria.svg)

***
## Table of Contents
- [Escape Room 404 - Factoría F5](#escape-room-404---factoría-f5)
  - [Table of Contents](#table-of-contents)
  - [General Information](#general-information)
  - [Screenshots](#screenshots)
  - [Technologies](#technologies)
    - [Backend Technologies](#backend-technologies)
    - [Frontend Technologies](#frontend-technologies)
  - [Installation](#installation)
    - [Backend Installation](#backend-installation)
    - [Frontend Installation](#frontend-installation)
  - [Versions](#versions)
    - [Plugins](#plugins)
  - [Deployment](#deployment)
  - [Support](#support)
  - [Authors](#authors)
  - [FAQs](#faqs)
  - [About the project](#about-the-project)
  - [Tools](#tools)
  - [Methodology](#methodology)
***
## General Information
Escape Room 404 is a virtual escape room designed by Factoria F5 to assess the competencies of candidates during their selection process. 

***

## Screenshots

<table>
<tr>
<td><img src="./src/assets/screenshots/screenshot001.png"></td>
<td><img src="./src/assets/screenshots/screenshot002.png"></td>
<td><img src="./src/assets/screenshots/screenshot003.png"></td>
<td><img src="./src/assets/screenshots/screenshot004.png"></td>
</tr>
<tr>
<td><img src="./src/assets/screenshots/screenshot005.png"></td>
<td><img src="./src/assets/screenshots/screenshot006.png"></td>
<td><img src="./src/assets/screenshots/screenshot007.png"></td>
<td><img src="./src/assets/screenshots/screenshot008.png"></td>
</tr>
<tr>
<td><img src="./src/assets/screenshots/screenshot009.png"></td>
<td><img src="./src/assets/screenshots/screenshot010.png"></td>
<td><img src="./src/assets/screenshots/screenshot011.png"></td>
<td><img src="./src/assets/screenshots/screenshot012.png"></td>
</tr>
<tr>
<td><img src="./src/assets/screenshots/screenshot013.png"></td>
<td><img src="./src/assets/screenshots/screenshot014.png"></td>
</tr>
</table>

***

## Technologies

The project was developed with the following technologies

### Backend Technologies

- Laravel Framework
- Laravel Sanctum
- Laravel Tinker
- Pusher PHP Server
- GuzzleHttp
- Tymon JWT Auth
- Postman

<p align="center">
<img src= "https://img.shields.io/badge/laravel-%23FF2D20.svg?style=for-the-badge&logo=laravel&logoColor=white">
<img src= "https://img.shields.io/badge/laravel--sanctum-%23FF2D20.svg?style=for-the-badge&logo=laravel&logoColor=white">
<img src= "https://img.shields.io/badge/laravel--tinker-%23FF2D20.svg?style=for-the-badge&logo=laravel&logoColor=white">
<img src= "https://img.shields.io/badge/pusher-%2333457D.svg?style=for-the-badge&logo=pusher&logoColor=white">
<img src= "https://img.shields.io/badge/guzzlehttp-%23000000.svg?style=for-the-badge&logo=guzzle&logoColor=white">
<img src= "https://img.shields.io/badge/tymon%20jwt%20auth-%23FF2D20.svg?style=for-the-badge&logo=json-web-tokens&logoColor"> 
<img src= "https://img.shields.io/badge/postman-%23FF6C37.svg?style=for-the-badge&logo=postman&logoColor=white">
 </p>

### Frontend Technologies

- Axios
- Bootstrap
- Framer Motion
- Prop-Types
- Pusher-js
- React
- React-Bootstrap
- React-DOM
- React-Hook-Form
- React-Router-DOM
- Styled-Components
- Sweetalert
- Vite-Plugin-Svgr
- Babel
- Jest

<p align="center">
<img src= "https://img.shields.io/badge/react-%2320232a.svg?style=for-the-badge&logo=react&logoColor=%2361DAFB">
<img src= "https://img.shields.io/badge/bootstrap-%23563D7C.svg?style=for-the-badge&logo=bootstrap&logoColor=white">
<img src= "https://img.shields.io/badge/axios-%23F2C811.svg?style=for-the-badge&logo=axios&logoColor=black">
<img src= "https://img.shields.io/badge/framer%20motion-%23F24E1E.svg?style=for-the-badge&logo=framer-motion&logoColor=white">
<img src= "https://img.shields.io/badge/prop--types-%23323330.svg?style=for-the-badge&logo=react&logoColor=%2361DAFB">
<img src= "https://img.shields.io/badge/react--bootstrap-%23563D7C.svg?style=for-the-badge&logo=bootstrap&logoColor=white">
<img src= "https://img.shields.io/badge/react--dom-%2320232a.svg?style=for-the-badge&logo=react&logoColor=%2361DAFB">
<img src= "https://img.shields.io/badge/react--hook--form-%23000000.svg?style=for-the-badge&logo=react&logoColor=%2361DAFB">
<img src= "https://img.shields.io/badge/react--router--dom-%23CA4245.svg?style=for-the-badge&logo=react-router&logoColor=white">
<img src= "https://img.shields.io/badge/styled--components-%23DB7093.svg?style=for-the-badge&logo=styled-components&logoColor=white">
<img src= "https://img.shields.io/badge/sweetalert-%23EE3545.svg?style=for-the-badge&logo=sweetalert&logoColor=white">
<img src= "https://img.shields.io/badge/vite--plugin--svgr-%23222222.svg?style=for-the-badge&logo=svg&logoColor=white">
<img src= "https://img.shields.io/badge/babel-%23F9DC3E.svg?style=for-the-badge&logo=babel&logoColor=black">
<img src= "https://img.shields.io/badge/jest-%23C21325.svg?style=for-the-badge&logo=jest&logoColor=white">


***

## Installation

### Backend Installation

To install and run the backend of Escape Room 404, please follow the steps below:

1- Ensure that you have PHP 8.0.2 or higher and Composer installed on your machine.

2- Clone the [repository from GitHub](https://github.com/fcegatti/escape-room-backend).

3- Navigate to the root directory of the project in your terminal.

4- Run `composer install` to install all the necessary dependencies.

5- Copy the .env.example file to a new file named .env, and update the configuration variables as needed.

6- Run `php artisan key:generate` to generate an application key.

7- Run `php artisan migrate` to run the database migrations.

8- To start the development server, use the command `php artisan serve`. This will start a local development server on http://localhost:8000/.

9- To build the project for production, you can use a tool like Laravel Forge or Laravel Envoyer to deploy your application to a production server. Alternatively, you can use a cloud hosting platform like Heroku to host your application.

### Frontend Installation

To install and run the frontend of Escape Room 404, please follow the steps below:

1- Ensure that you have Node.js installed on your machine. You can download it from the [official website](https://nodejs.org/en/download/).
2- Clone the [repository from GitHub](https://github.com/AleMCuitino/escape-room-frontend).
3- Navigate to the root directory of the project in your terminal.
4- Run `npm install` to install all the necessary dependencies.
5- To run the development server, use the command `npm run dev`. This will start a local development server on http://localhost:3000/.
6- To build the project for production, use the command `npm run build`. This will create a **dist** directory with the compiled code.
7- To preview the production build, use the command `npm run preview`.

***
## Versions

- Node.js: v14.16.1
- npm: 6.14.12
- React: 18.2.0
- Laravel: 9.19
- PHP: 8.0.2

### Plugins

- @vitejs/plugin-react: 3.1.0
- laravel-vite-plugin: 0.7.2
- vite-plugin-svgr: 2.4.0



***
## Deployment

  
[Visit our link](https://escape-room-backend-mcprj.ondigitalocean.app/api)


***


## Support

To handle any enquiries contact
>andres.patino@factoriaf5.org
***


## Authors

[Gary Lima](https://github.com/GaryHL)<br>
[Rodrigo Fernández](https://github.com/Rodrigo-ASJ)   
[Carla Luppi](https://github.com/carlaluppi)  
[Alejandra Morales Cuitiño](https://github.com/AleMCuitino)     
[federico gatti](https://github.com/fcegatti)



***
## FAQs

We'll fill this field when you ask something

## About the project

This project was developed as the final presentation of the P5.2022-23 class of the Full Stack bootcamp at Factoria F5.


## Tools

- Figma
- Notion
- GitHub
- Digital Ocean


<p align="center">
<a href="https://www.figma.com"><img src="https://img.shields.io/badge/Figma-%23F24E1E.svg?style=for-the-badge&logo=Figma&logoColor=white"></a>
<a href="https://www.notion.so"><img src="https://img.shields.io/badge/Notion-%23000000.svg?style=for-the-badge&logo=Notion&logoColor=white"></a>
<a href="https://github.com"><img src="https://img.shields.io/badge/GitHub-%23181717.svg?style=for-the-badge&logo=GitHub&logoColor=white"></a>
<a href="https://www.digitalocean.com"><img src="https://img.shields.io/badge/DigitalOcean-%230167ff.svg?style=for-the-badge&logo=DigitalOcean&logoColor=white"></a>
</p>

## Methodology

* Agile and SCRUM.
* Pair programming.




