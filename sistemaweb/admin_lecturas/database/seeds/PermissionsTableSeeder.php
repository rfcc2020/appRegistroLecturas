<?php

use Illuminate\Database\Seeder;

use Caffeinated\Shinobi\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Users
        Permission::create([
            'name'          => 'Navegar usuarios',
            'slug'          => 'users.index',
            'description'   => 'Lista y navega todos los usuarios del sistema',
        ]);

        Permission::create([
            'name'          => 'Ver detalle de usuario',
            'slug'          => 'users.show',
            'description'   => 'Ve en detalle cada usuario del sistema',            
        ]);
        
        Permission::create([
            'name'          => 'Edición de usuarios',
            'slug'          => 'users.edit',
            'description'   => 'Podría editar cualquier dato de un usuario del sistema',
        ]);
        
        Permission::create([
            'name'          => 'Eliminar usuario',
            'slug'          => 'users.destroy',
            'description'   => 'Podría eliminar cualquier usuario del sistema',      
        ]);

        //Roles
        Permission::create([
            'name'          => 'Navegar roles',
            'slug'          => 'roles.index',
            'description'   => 'Lista y navega todos los roles del sistema',
        ]);

        Permission::create([
            'name'          => 'Ver detalle de un rol',
            'slug'          => 'roles.show',
            'description'   => 'Ve en detalle cada rol del sistema',            
        ]);
        
        Permission::create([
            'name'          => 'Creación de roles',
            'slug'          => 'roles.create',
            'description'   => 'Podría crear nuevos roles en el sistema',
        ]);
        
        Permission::create([
            'name'          => 'Edición de roles',
            'slug'          => 'roles.edit',
            'description'   => 'Podría editar cualquier dato de un rol del sistema',
        ]);
        
        Permission::create([
            'name'          => 'Eliminar roles',
            'slug'          => 'roles.destroy',
            'description'   => 'Podría eliminar cualquier rol del sistema',      
        ]);

        //Roles
        Permission::create([
            'name'          => 'Navegar productos',
            'slug'          => 'products.index',
            'description'   => 'Lista y navega todos los productos del sistema',
        ]);

        Permission::create([
            'name'          => 'Ver detalle de un producto',
            'slug'          => 'products.show',
            'description'   => 'Ve en detalle cada producto del sistema',            
        ]);
        
        Permission::create([
            'name'          => 'Creación de productos',
            'slug'          => 'products.create',
            'description'   => 'Podría crear nuevos productos en el sistema',
        ]);
        
        Permission::create([
            'name'          => 'Edición de productos',
            'slug'          => 'products.edit',
            'description'   => 'Podría editar cualquier dato de un producto del sistema',
        ]);
        
        Permission::create([
            'name'          => 'Eliminar productos',
            'slug'          => 'products.destroy',
            'description'   => 'Podría eliminar cualquier producto del sistema',      
        ]);

//Personas
        Permission::create([
            'name'          => 'Navegar personas',
            'slug'          => 'personas.index',
            'description'   => 'Lista y navega todas las personas del sistema',
        ]);

        Permission::create([
            'name'          => 'Ver detalle de una persona',
            'slug'          => 'personas.show',
            'description'   => 'Ve en detalle cada persona del sistema',            
        ]);
        
        Permission::create([
            'name'          => 'Creación de personas',
            'slug'          => 'personas.create',
            'description'   => 'Podría crear nuevas personas en el sistema',
        ]);
        
        Permission::create([
            'name'          => 'Edición de personas',
            'slug'          => 'personas.edit',
            'description'   => 'Podría editar cualquier dato de una persona del sistema',
        ]);
        
        Permission::create([
            'name'          => 'Eliminar personas',
            'slug'          => 'personas.destroy',
            'description'   => 'Podría eliminar cualquier persona del sistema',      
        ]);
//Medidores
        Permission::create([
            'name'          => 'Navegar medidores',
            'slug'          => 'medidores.index',
            'description'   => 'Lista y navega todos los medidores del sistema',
        ]);

        Permission::create([
            'name'          => 'Ver detalle de medidor',
            'slug'          => 'medidores.show',
            'description'   => 'Ve en detalle cada medidor del sistema',            
        ]);
        
        Permission::create([
            'name'          => 'Edición de medidores',
            'slug'          => 'medidores.edit',
            'description'   => 'Podría editar cualquier dato de un medidor del sistema',
        ]);
        
        Permission::create([
            'name'          => 'Eliminar medidor',
            'slug'          => 'medidores.destroy',
            'description'   => 'Podría eliminar cualquier medidor del sistema',      
        ]);
//Requerimientos
        Permission::create([
            'name'          => 'Navegar Requerimientos',
            'slug'          => 'requerimientos.index',
            'description'   => 'Lista y navega todos los requerimientos del sistema',
        ]);

        Permission::create([
            'name'          => 'Ver detalle de requerimiento',
            'slug'          => 'requerimientos.show',
            'description'   => 'Ve en detalle cada requerimiento del sistema',            
        ]);
        
        Permission::create([
            'name'          => 'Edición de requerimiento',
            'slug'          => 'requerimientos.edit',
            'description'   => 'Podría editar cualquier dato de un requerimiento del sistema',
        ]);
        
        Permission::create([
            'name'          => 'Eliminar requerimiento',
            'slug'          => 'requerimientos.destroy',
            'description'   => 'Podría eliminar cualquier requerimiento del sistema',      
        ]);
//Notificaciones
        Permission::create([
            'name'          => 'Navegar Notificaciones',
            'slug'          => 'notificaciones.index',
            'description'   => 'Lista y navega todos las notificaciones del sistema',
        ]);

        Permission::create([
            'name'          => 'Ver detalle de notificacion',
            'slug'          => 'notificaciones.show',
            'description'   => 'Ve en detalle cada notificacion del sistema',            
        ]);
        
        Permission::create([
            'name'          => 'Edición de notificaciones',
            'slug'          => 'notificaciones.edit',
            'description'   => 'Podría editar cualquier dato de una notificacion del sistema',
        ]);
        
        Permission::create([
            'name'          => 'Eliminar notificacion',
            'slug'          => 'notificaciones.destroy',
            'description'   => 'Podría eliminar cualquier notificacion del sistema',      
        ]);
    }
}
