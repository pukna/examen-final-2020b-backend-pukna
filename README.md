# Examen Final 2020B

- Crear una API en Laravel y su respectivo frontend para la siguiente aplicación. El presente repositorio ya contiene inicializado un proyecto de Laravel con la versión 6 (ver la descripción más abajo). Para el Frontend debe usar el repositorio correspondiente, desde el link compartido.
- El frontend debe permitir:
    - Registro de usuarios
    - Inicio de sesión de usuario
    - Cada usuario puede registrar sus productos
    - Cada usuario puede ver una lista de sus productos registrados en una tabla con código y nombre. Al hacer clic en un botón "ver más" se debe visiualizar todos los detalles del producto.

- Este proyecto base contiene una API con las siguientes entidades. El proyecto ya contiene las migraciones, modelos, controladores, seeder y rutas para estas entidades. Además, ya tiene implementado el JWT pero no lo maneja comoo cookie, puede implementar el uso de JWT mediante cookies. 

```
- users
  - id : bigint(20) unsigned
  - name : varchar(255)
  - email : varchar (255)
  - email_verified_at : timestamp
  - password : varchar(255)
  - remember_token : varchar(100)
  - created_at : timestamp
  - updated_at : timestamp
 
 
- products
  - id : bigint(20) unsigned
  - name : varchar(255)
  - code : varchar(80)
  - price : double
  - status : enum('active','deleted')
  - created_at : timestamp
  - updated_at : timestamp
  
  
- customers
  - id : bigint(20) unsigned
  - name : varchar(255)
  - lastname : varchar(255)
  - document : varchar(80)
  - created_at : timestamp
  - updated_at : timestamp

```

A partir de esta API, desarrollar las siguientes tareas:

1. Agregar una entidad `suppliers` con los siguientes atributos:
    ```
    - suppliers
      - id: bigint(20) unsigned
      - name: varchar(255)
      - registered_by: bigint(20) unsigned
      - created_at : timestamp
      - updated_at : timestamp
    ```
1. Desarrollar la migración, modelo, controlador, rutas y seeders para `suppliers`
1. El campo `registered_by` debe ser llenado de manera automática cuando se registra un nuevo `suppliers` con el `id` de usuario que envía la petición (el usuario al que pertenece la sesión).
1. Implementar la relación de muchos a muchos entre `suppliers` y `products`. Es decir un proveeder ofrece muchos productos y un producto es ofrecido por muchos proveedores. Debe modificar los seeders correspondientes para que tomen en cuenta esta relación.
1. Modificar los controladores para implementar la validación de datos. Con las siguientes reglas:
    ```
    - products
      - name : string, obligatorio
      - code : string, máximo 10 caracteres
      - price : double

    - customers
      - name : string, obligatorio
      - lastname : string, obligatorio
      - document : string, obligatorio, máximo 10 caracteres

    - suppliers
      - name: string, obligatorio
    ```
