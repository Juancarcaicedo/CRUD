<?php
class Model_usuario extends Orm\Model /* Un ORM es un modelo de programación que permite mapear las estructuras de una base de datos relacional*/
{
protected static $_table_name = 'usuario';
protected static $_properties = array ('id','nombres','rol','ocupacion');/* PROPIEDADES DE LA TABLA USUARIO*/
}