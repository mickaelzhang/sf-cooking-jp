# sf-cooking-jp
Symfony project

## Team member
* Benjamin Corsini
* Thaddé Meneur
* Sulivan Nguyen
* Raphaël Piacitelli
* Clément Vion
* Mickaël Zhang

## Table of contents
* [Commit - Tag](#commit-tags)
* [CLI Command](#cli-command)
* [Getting started](#getting-started)
* [Project view structure](#twig-structure)
* [View namespace](#view-namespace)
* [API documentation](docs/api/README.md)

## <a name="commit-tags">Commit - Tags</a>
- [X] [ADD] - Add new files / dependencies
- [X] [REMOVE] - Remove files / dependencies
- [X] [UPDATE] - Update important part of the project
- [X] [FIX] - Fix bugs, codes and other stuff

## <a name="cli-command">CLI Command</a>
- `composer regenerate-db`: Regenerate database with false data
- `npm run start`: Start Gulp tasks

## <a name="getting-started">Getting started</a>
In order to setup the project, please follow these few steps.

#### Requirement

- [Composer](https://getcomposer.org/)
- [NPM](https://docs.npmjs.com/getting-started/installing-node)
- A MySQL server

#### Setup

You will need to write these commands in your terminal.
Don't forge to be in project's root directory.

```
$ composer install
$ composer regenerate-db
$ npm install
$ gulp build
$ php bin/console server:run
```


## <a name="twig-structure">Project view structure</a>
The project view is located in `app/Resources/views`.

When you are in `app/Resources/views`, you can see that their is only 2 folders `admin` and `frontend`. It is to separate .twig template that are used for the `admin` and `frontend` interface. The reason is that those 2 interfaces possess different template for the view.

For example, if go into frontend, the file structure look like this :

```
frontend/
    |- bases/
    |- components/
    |- layouts/
    |- pages/
        |- user/
            |- show.html.twig
            |- edit.html.twig
            ...
        |- recipe/
        ...
    |- templates/
```

#### 'bases' folder
The `bases` folder contained `twig` files that are the basis for the view. It should be those file that has the html, head and body tag.

#### 'components' folder
The `components` folder contained `twig` files for components that can be reusable. The most obvious usage would be button.

#### 'layouts' folder
The `layouts` folder contained `twig` files for layout level template such as header, footer or sidebar.

#### 'pages' folder
The `pages` folder contained `twig` files for specific pages. Most of the time, you render a file from this folder.

Twig view that surround a certain entity should be grouped in their specific folder.
For example, the app could have an entity **User** and a `ShowAction`, `EditAction` and `NewAction`, the pages folder would look like this :

```
pages/
    |- user/
        |- show.html.twig
        |- edit.html.twig
        |- new.html.twig
    ...
```

#### 'templates' folder
The `templates` folder contained `twig` files for template. They should be reusable, if you find yourself, including a specific header twig file too much for example, it could be a good idea to place it here and extend the template file.

## <a name="view-namespace">View namespace</a>

Since you should only render pages twig template, use the appropriate namespace.
Right now, the project possess 2 namespace for the view:
- `admin` : For the admin interface
- `frontend` : For the website

```php
<?php

// BAD
public function indexAction()
{
    return $this->render('frontend/pages/recipe/index.html.twig');
}

// GOOD
public function indexAction()
{
    return $this->render('@frontend/recipe/index.html.twig');
}

```

