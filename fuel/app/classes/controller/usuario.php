<?php

class Controller_usuario extends Controller_Template {

    public function action_index() {
        $data = array();
        $data['usuarios'] = Model_usuario::find('all');
        $this->template->title = "usuario List";
        $this->template->content = View::forge('usuario/index', $data, false);
    }

    public function action_view($id) {
        $usuario = Model_usuario::find('first', array(
                    'where' => array(
                        'id' => $id
                    )
                        )
        );

        if ($usuario == null) {
            throw new HttpNotFoundException();
        }
        $data = array('usuario' => $usuario);
        $this->template->title = "View Usuario";
        $this->template->content = View::forge('usuario/view', $data, false);
    }

    public function action_create() {
        $data = array();

        // coton para craear dear 
        if (Input::post('create')) {

            $val = Validation::forge();

            $val->add('nombres', 'Nombres')->add_rule('required')
                    ->add_rule('min_length', 3)
                    ->add_rule('max_length', 30);

            $val->add('rol', 'Rol')->add_rule('required')
                    ->add_rule('min_length', 3)
                    ->add_rule('max_length', 30);

            $val->add('ocupacion', 'Ocupacion')->add_rule('required')
                    ->add_rule('min_length', 3)
                    ->add_rule('max_length', 30);


            // si la validacion es exitosa 
            if ($val->run()) {
                // obtener una matriz de campos validados con éxito => pares de valores
                $validatedFields = $val->validated();
                // creo usuario usando el modelo y lo guardo en la bd 
                $usuario = new Model_usuario();
                $usuario->nombres = $validatedFields['nombres'];
                $usuario->rol = $validatedFields['rol'];
                $usuario->ocupacion = $validatedFields['ocupacion'];
                $usuario->save();
                //redirigir a la lista de usuarios
                Response::redirect('/usuario');
            }
            // si la validacion es falsa 
            // rederigir a mensaje con error 
            else {
                // obtener una matriz de errores de validación como campo => pares de errores
                $data['errors'] = $val->error();
                $this->template->title = "Crear USUARIO ";
                $this->template->content = View::forge('usuario/create', $data, false);
            }
        }
        // mostrar formulario en la carga de una nueva página
        else {
            $this->template->title = "Crear USUARIO";
            $this->template->content = View::forge('usuario/create', $data, false);
        }
    }

    public function action_edit($id) {
        $data = array();
        // busca si el Usuario  existe o no  en la base de datos 
        $usuario = Model_usuario::find('first', array(
                    'where' => array(
                        'id' => $id
                    )
                        )
        );

        if ($usuario == null) {
            //mensaje de excepcion no se encuentra 
            throw new HttpNotFoundException();
        }

        //boton para actualizar 
        if (Input::post('update')) {

              $val = Validation::forge();

            $val->add('nombres', 'Nombres')->add_rule('required')
                    ->add_rule('min_length', 3)
                    ->add_rule('max_length', 30);

            $val->add('rol', 'Rol')->add_rule('required')
                    ->add_rule('min_length', 3)
                    ->add_rule('max_length', 30);

            $val->add('ocupacion', 'Ocupacion')->add_rule('required')
                    ->add_rule('min_length', 3)
                    ->add_rule('max_length', 30);

            // si la validacion es correcta 
            if ($val->run()) {
                // obtener una matriz de campos validados con éxito => pares de valores
                $validatedFields = $val->validated();
                //actualizar los valores del modelo de estudiante existente y guardar en bd  
                $usuario->nombres = $validatedFields['nombres'];
                $usuario->rol = $validatedFields['rol'];
                $usuario->ocupacion = $validatedFields['ocupacion'];
                $usuario->save();
                //redirigir a la lista de usuarios
                Response::redirect('/usuario');
            }
            // si la validacion  tiene error 
            // rederigir con mensaje de error 
            else {
                 // obtener una matriz de errores de validación como campo => pares de errores
                // establecer error 
                $data['errors']= $val->error();
                //set student value to last filled values
                $usuario->nombres = Input::post('nombres');
                $usuario->rol = Input::post('rol');
                $usuario->ocupacion = Input::post('rol');
                $data['usuario']= $usuario;
                $this->template->title="Edit Usuario";
                $this->template->content=View::forge('usuario/edit',$data,false);
            }
        }
        //  mostrar formulario en la carga de una nueva página
        else {
            // establecer usuario de db
            $data['usuario'] = $usuario;
            $this->template->title = "Edit Usuario";
            $this->template->content = View::forge('usuario/edit', $data, false);
        }
    }
    public function action_delete($id)
    {
        //comporbar si el usuario existe o no
        $usuario = Model_usuario::find('first',
        array(
            'where' => array(
                'id' =>  $id
            )
        )
        );
        
        if($usuario==null){
             throw new HttpNotFoundException();
        }
        //eliminar estudiante
        $usuario->delete();
        //rederigir a lista de estudiantes 
        Response::redirect('/usuario/');
    }
}


