# sf-cooking-jp
Symfony project

## Team member
* Benjamin Corsini
* Thaddé Meneur
* Sulivan Nguyen
* Raphëal Piacitellio
* Clément Vion
* Mickaël Zhang

## Project view structure
The project view is located in `app/Resources/views`.

When you are in `app/Resources/views`, you can see that their is only 2 folders `admin` and `frontend`. It is to separate .twig template that are used for the `admin` and `frontend` interface. The reason is that those 2 interfaces possess different template for the view.

For exemple, if go into frontend, the file structure look like this :

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
