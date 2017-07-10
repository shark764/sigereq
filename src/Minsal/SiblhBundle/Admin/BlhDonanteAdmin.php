<?php

namespace Minsal\SiblhBundle\Admin;

use Minsal\SiblhBundle\Admin\MinsalSiblhBundleGeneralAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

use Doctrine\ORM\EntityRepository;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Route\RouteCollection;

class BlhDonanteAdmin extends MinsalSiblhBundleGeneralAdmin
{
    protected $baseRouteName    = 'siblh_donante';
    protected $baseRoutePattern = 'blh/donante';

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            // ->add('id')
            ->add('codigoDonante')
            ->add('primerNombre')
            ->add('segundoNombre')
            ->add('primerApellido')
            ->add('segundoApellido')
            ->add('fechaNacimiento')
            ->add('fechaRegistroDonanteBlh')
            ->add('telefonoFijo')
            ->add('telefonoMovil')
            ->add('direccion')
            ->add('procedencia')
            ->add('registro')
            ->add('numeroDocumentoIdentificacion')
            ->add('documentoIdentificacion')
            ->add('edad')
            ->add('ocupacion')
            ->add('estadoCivil')
            ->add('escolaridad')
            ->add('tipoColecta')
            ->add('observaciones')
            ->add('estado')
            // ->add('usuario')
            // ->add('fechaHoraReg')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            // ->add('id')
            ->add('codigoDonante')
            ->add('primerNombre')
            ->add('segundoNombre')
            ->add('primerApellido')
            ->add('segundoApellido')
            ->add('fechaNacimiento')
            ->add('fechaRegistroDonanteBlh')
            ->add('telefonoFijo')
            ->add('telefonoMovil')
            ->add('direccion')
            ->add('procedencia')
            ->add('registro')
            ->add('numeroDocumentoIdentificacion')
            ->add('documentoIdentificacion')
            ->add('edad')
            ->add('ocupacion')
            ->add('estadoCivil')
            ->add('escolaridad')
            ->add('tipoColecta')
            ->add('observaciones')
            ->add('estado')
            // ->add('usuario')
            // ->add('fechaHoraReg')
            ->add('_action', 'actions', array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'delete' => array(),
                )
            ))
        ;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            // ->add('id')
            ->add('idBancoDeLeche', null, array(
                            'label' => 'Banco de Leche',
                            'label_attr' => array('class' => 'label_form_sm'),
                            // 'required' => true,
                            // 'group_by' => 'idEstablecimiento',
                            'attr' => array(
                                    'class' => 'form-control input-sm',

                                    'data-add-input-addon' => 'true',
                                    // 'data-add-input-addon-class' => 'primary-v4',
                                    'data-add-input-addon-addon' => 'glyphicon glyphicon-home',
                            )
            ))
            ->add('idCentroRecoleccion', null, array(
                            'label' => 'Centro de recolección',
                            'label_attr' => array('class' => 'label_form_sm'),
                            'required' => true,
                            'group_by' => 'idBancoDeLeche',
                            'attr' => array(
                                    'class' => 'form-control input-sm',

                                    'data-add-input-addon' => 'true',
                                    // 'data-add-input-addon-class' => 'primary-v4',
                                    'data-add-input-addon-addon' => 'glyphicon glyphicon-home',
                            )
            ))
            ->add('codigoDonante', null, array(
                            'label' => 'Código',
                            'label_attr' => array('class' => 'label_form_sm'),
                            'required' => false,
                            'attr' => array(
                                    'placeholder' => 'código...',
                                    'class' => 'form-control input-sm',
                                    'readonly' => 'readonly',
                                    'data-add-form-group-col-class' => 'col-lg-4 col-md-4 col-sm-4',

                                    'data-add-input-addon' => 'true',
                                    'data-add-input-addon-addon' => 'glyphicon glyphicon-barcode',
                            )
            ))
            ->add('primerNombre', null, array(
                            'label' => '<span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp; Nombre'/*Primer nombre'*/,
                            'label_attr' => array('class' => 'label_form_sm'),
                            'required' => true,
                            'attr' => array(
                                    'placeholder' => 'primer nombre...',
                                    'class' => 'form-control input-sm',
                                    'data-form-inline-group' => 'start',
                                    'data-add-form-group-col-class' => 'col-lg-4 col-md-4 col-sm-4',

                                    'data-add-input-addon' => 'true',
                                    // 'data-add-input-addon-class' => 'primary-v4',
                                    'data-add-input-addon-addon' => 'glyphicon glyphicon-user',

                                    'data-fv-stringlength' => 'true',
                                    'data-fv-stringlength-min' => '1',
                                    'data-fv-stringlength-message' => '1 caracter mínimo',

                                    'data-fv-regexp' => 'true',
                                    // 'data-fv-regexp-regexp' => self::___CLASS_REGEX_MINIMAL___,
                                    'data-fv-regexp-regexp' => self::___CLASS_REGEX_TEXT_ONLY___,
                                    'data-fv-regexp-message' => 'Texto contiene caracteres no permitidos',
                            )
            ))
            ->add('segundoNombre', null, array(
                            'label' => false/*'<span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp; Segundo nombre'*/,
                            // 'label_attr' => array('class' => 'label_form_sm'/* col-lg-2 col-md-2 col-sm-2'*/),
                            'required' => false,
                            'attr' => array(
                                    'placeholder' => 'segundo nombre...',
                                    'class' => 'form-control input-sm',
                                    // 'data-form-inline-group' => 'continue',
                                    'data-form-inline-group' => 'stop',
                                    'data-add-form-group-col-class' => 'col-lg-4 col-md-4 col-sm-4',

                                    'data-add-input-addon' => 'true',
                                    // 'data-add-input-addon-class' => 'primary-v4',
                                    'data-add-input-addon-addon' => 'glyphicon glyphicon-user',

                                    'data-fv-stringlength' => 'true',
                                    'data-fv-stringlength-min' => '1',
                                    'data-fv-stringlength-message' => '1 caracter mínimo',

                                    'data-fv-regexp' => 'true',
                                    // 'data-fv-regexp-regexp' => self::___CLASS_REGEX_MINIMAL___,
                                    'data-fv-regexp-regexp' => self::___CLASS_REGEX_TEXT_ONLY___,
                                    'data-fv-regexp-message' => 'Texto contiene caracteres no permitidos',
                            )
            ))
            ->add('primerApellido', null, array(
                            'label' => '<span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp; Apellido'/*Primer apellido'*/,
                            'label_attr' => array('class' => 'label_form_sm'),
                            'required' => true,
                            'attr' => array(
                                    'placeholder' => 'primer apellido...',
                                    'class' => 'form-control input-sm',
                                    'data-form-inline-group' => 'start',
                                    'data-add-form-group-col-class' => 'col-lg-4 col-md-4 col-sm-4',

                                    'data-add-input-addon' => 'true',
                                    // 'data-add-input-addon-class' => 'primary-v4',
                                    'data-add-input-addon-addon' => 'glyphicon glyphicon-user',

                                    'data-fv-stringlength' => 'true',
                                    'data-fv-stringlength-min' => '1',
                                    'data-fv-stringlength-message' => '1 caracter mínimo',

                                    'data-fv-regexp' => 'true',
                                    // 'data-fv-regexp-regexp' => self::___CLASS_REGEX_MINIMAL___,
                                    'data-fv-regexp-regexp' => self::___CLASS_REGEX_TEXT_ONLY___,
                                    'data-fv-regexp-message' => 'Texto contiene caracteres no permitidos',
                            )
            ))
            ->add('segundoApellido', null, array(
                            'label' => false/*'<span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp; Segundo apellido'*/,
                            // 'label_attr' => array('class' => 'label_form_sm'/* col-lg-2 col-md-2 col-sm-2'*/),
                            'required' => false,
                            'attr' => array(
                                    'placeholder' => 'segundo apellido...',
                                    'class' => 'form-control input-sm',
                                    'data-form-inline-group' => 'stop',
                                    'data-add-form-group-col-class' => 'col-lg-4 col-md-4 col-sm-4',

                                    'data-add-input-addon' => 'true',
                                    // 'data-add-input-addon-class' => 'primary-v4',
                                    'data-add-input-addon-addon' => 'glyphicon glyphicon-user',

                                    'data-fv-stringlength' => 'true',
                                    'data-fv-stringlength-min' => '1',
                                    'data-fv-stringlength-message' => '1 caracter mínimo',

                                    'data-fv-regexp' => 'true',
                                    // 'data-fv-regexp-regexp' => self::___CLASS_REGEX_MINIMAL___,
                                    'data-fv-regexp-regexp' => self::___CLASS_REGEX_TEXT_ONLY___,
                                    'data-fv-regexp-message' => 'Texto contiene caracteres no permitidos',
                            )
            ))
            ->add('idMunicipio', null, array(
                            'label' => 'Procedencia',
                            'label_attr' => array('class' => 'label_form_sm'),
                            'required' => false,
                            'attr' => array(
                                    'class' => 'form-control input-sm',
                                    // 'data-form-inline-group' => 'start',
                                    // 'data-add-form-group-col-class' => 'col-lg-4 col-md-4 col-sm-4',

                                    'data-add-input-addon' => 'true',
                                    // 'data-add-input-addon-class' => 'primary-v4',
                                    'data-add-input-addon-addon' => 'glyphicon glyphicon-home',
                            )
            ))
            ->add('nacionalidad', null, array(
                            'label' => 'Nacionalidad',
                            'label_attr' => array('class' => 'label_form_sm'),
                            'required' => false,
                            'attr' => array(
                                    'class' => 'form-control input-sm',
                                    // 'data-form-inline-group' => 'start',
                                    // 'data-add-form-group-col-class' => 'col-lg-4 col-md-4 col-sm-4',

                                    'data-add-input-addon' => 'true',
                                    // 'data-add-input-addon-class' => 'primary-v4',
                                    'data-add-input-addon-addon' => 'glyphicon glyphicon-globe',
                            )
            ))
            ->add('fechaNacimiento', 'datetime', array(
                            'label' => 'Fecha de nacimiento',
                            'label_attr' => array('class' => 'label_form_sm'),
                            // 'help' => '',
                            'required' => false,
                            'widget' => 'single_text',
                            'format' => 'dd/MM/yyyy',
                            'attr' => array(
                                    // 'readonly' => 'readonly',
                                    'placeholder' => 'DD/MM/YYYY',
                                    'class' => 'form-control input-sm',
                                    'data-input-transform' => 'datetimepicker',
                                    'data-datetimepicker-type' => 'date',
                                    'data-form-inline-group' => 'start',
                                    'data-add-form-group-col-class' => 'col-lg-4 col-md-4 col-sm-4',

                                    'data-add-input-addon' => 'true',
                                    // 'data-add-input-addon-class' => 'primary-v4',
                                    'data-add-input-addon-addon' => 'glyphicon glyphicon-time',

                                    // 'data-add-input-btn' => 'true',
                                    // 'data-add-input-btn-class' => 'display-datetimepicker',
                                    // 'data-add-input-btn-btn-class' => 'btn-sm btn-xray-awesome-blue background-opacity display-datetimepicker',
                                    // 'data-add-input-btn-addon' => 'glyphicon glyphicon-time',

                                    'data-fv-date' => 'true',
                                    'data-fv-date-format' => 'DD/MM/YYYY',
                                    'data-fv-date-message' => 'No es una fecha válida',
                            )
            ))
            ->add('edad', null, array(
                            'label' => false/*'Edad'*/,
                            'label_attr' => array('class' => 'label_form_sm'),
                            // 'help' => '<span class="text-primary-v4">Se calculará automáticamente.</span>',
                            'attr' => array(
                                    'class' => 'form-control input-sm',
                                    'placeholder' => 'edad...',
                                    'readonly' => 'readonly',
                                    'data-form-inline-group' => 'stop',
                                    'data-add-form-group-col-class' => 'col-lg-4 col-md-4 col-sm-4',

                                    'data-add-input-addon' => 'true',
                                    // 'data-add-input-addon-class' => 'primary-v4',
                                    'data-add-input-addon-addon' => 'glyphicon glyphicon-user',

                                    'data-fv-integer' => 'true',
                                    'data-fv-integer-message' => 'El valor no es un entero',

                                    'min' => '0',
                                    'max' => '32767',
                                    'data-fv-between-message' => 'Número debe estar entre 0 y 32767',
                            )
            ))
            // ->add('fechaRegistroDonanteBlh')
            ->add('telefonoFijo', null, array(
                            'label' => 'Teléfono',
                            'label_attr' => array('class' => 'label_form_sm'),
                            'required' => false,
                            'attr' => array(
                                    'placeholder' => 'teléfono fijo...',
                                    'class' => 'form-control input-sm',
                                    'data-form-inline-group' => 'start',
                                    'data-add-form-group-col-class' => 'col-lg-4 col-md-4 col-sm-4',

                                    'data-add-input-addon' => 'true',
                                    'data-add-input-addon-addon' => 'glyphicon glyphicon-earphone',
                            )
            ))
            ->add('telefonoMovil', null, array(
                            'label' => false/*'Teléfono móvil'*/,
                            'label_attr' => array('class' => 'label_form_sm'),
                            'required' => false,
                            'attr' => array(
                                    'placeholder' => 'teléfono móvil...',
                                    'class' => 'form-control input-sm',
                                    'data-form-inline-group' => 'stop',
                                    'data-add-form-group-col-class' => 'col-lg-4 col-md-4 col-sm-4',

                                    'data-add-input-addon' => 'true',
                                    'data-add-input-addon-addon' => 'glyphicon glyphicon-phone',
                            )
            ))
            // ->add('procedencia', null, array(
            //                 'label' => 'Procedencia',
            //                 'label_attr' => array('class' => 'label_form_sm'),
            //                 'required' => false,
            //                 'attr' => array(
            //                         // 'rows' => '2',
            //                         // 'style' => 'resize:none',
            //                         'placeholder' => 'procedencia...',
            //                         'class' => 'form-control input-sm',

            //                         'data-fv-stringlength' => 'true',
            //                         'data-fv-stringlength-min' => '5',
            //                         'data-fv-stringlength-message' => '5 caracteres mínimo',

            //                         'data-fv-regexp' => 'true',
            //                         'data-fv-regexp-regexp' => self::___CLASS_REGEX_EXTENDED___,
            //                         'data-fv-regexp-message' => 'Texto contiene caracteres no permitidos',
            //                 )
            // ))
            ->add('registro', null, array(
                            'label' => 'Número de registro',
                            'label_attr' => array('class' => 'label_form_sm'),
                            'required' => false,
                            'help' => '<span class="text-warning">Este número proviene del registro de expediente (CUN) del SIAP.</span>',
                            'attr' => array(
                                    'placeholder' => 'registro / expediente...',
                                    'class' => 'form-control input-sm',
                                    'readonly' => 'readonly',
                                    // 'data-form-inline-group' => 'stop',
                                    'data-add-form-group-col-class' => 'col-lg-4 col-md-4 col-sm-4',

                                    'data-add-input-addon' => 'true',
                                    // 'data-add-input-addon-class' => 'primary-v4',
                                    'data-add-input-addon-addon' => 'glyphicon glyphicon-barcode',

                                    'data-fv-stringlength' => 'true',
                                    'data-fv-stringlength-min' => '1',
                                    'data-fv-stringlength-message' => '1 caracter mínimo',

                                    'data-fv-regexp' => 'true',
                                    'data-fv-regexp-regexp' => self::___CLASS_REGEX_MINIMAL___,
                                    'data-fv-regexp-message' => 'Texto contiene caracteres no permitidos',
                            )
            ))
            // ->add('documentoIdentificacion', null, array(
            //                 'label' => 'Documento de identificación',
            //                 'label_attr' => array('class' => 'label_form_sm'),
            //                 'attr' => array(
            //                         'placeholder' => 'documento de identificación...',
            //                         'class' => 'form-control input-sm',
            //                         'data-form-inline-group' => 'start',
            //                         'data-add-form-group-col-class' => 'col-lg-4 col-md-4 col-sm-4',

            //                         'data-add-input-addon' => 'true',
            //                         // 'data-add-input-addon-class' => 'primary-v4',
            //                         'data-add-input-addon-addon' => 'glyphicon glyphicon-barcode',

            //                         'data-fv-stringlength' => 'true',
            //                         'data-fv-stringlength-min' => '1',
            //                         'data-fv-stringlength-message' => '1 caracter mínimo',

            //                         'data-fv-regexp' => 'true',
            //                         'data-fv-regexp-regexp' => self::___CLASS_REGEX_MINIMAL___,
            //                         'data-fv-regexp-message' => 'Texto contiene caracteres no permitidos',
            //                 )
            // ))
            ->add('idDoceDonante', null, array(
                            'label' => 'Documento de identificación',
                            'label_attr' => array('class' => 'label_form_sm'),
                            'required' => false,
                            'attr' => array(
                                    'class' => 'form-control input-sm',
                                    'data-form-inline-group' => 'start',
                                    'data-add-form-group-col-class' => 'col-lg-4 col-md-4 col-sm-4',

                                    'data-add-input-addon' => 'true',
                                    // 'data-add-input-addon-class' => 'primary-v4',
                                    'data-add-input-addon-addon' => 'glyphicon glyphicon-barcode',
                            )
            ))
            ->add('numeroDocumentoIdentificacion', null, array(
                            'label' => false/*'Número de documento de identificación'*/,
                            'label_attr' => array('class' => 'label_form_sm'),
                            'attr' => array(
                                    'placeholder' => 'número de documento de identificación...',
                                    'class' => 'form-control input-sm',
                                    'data-form-inline-group' => 'stop',
                                    'data-add-form-group-col-class' => 'col-lg-4 col-md-4 col-sm-4',

                                    'data-add-input-addon' => 'true',
                                    // 'data-add-input-addon-class' => 'primary-v4',
                                    'data-add-input-addon-addon' => 'glyphicon glyphicon-barcode',

                                    'data-fv-stringlength' => 'true',
                                    'data-fv-stringlength-min' => '1',
                                    'data-fv-stringlength-message' => '1 caracter mínimo',

                                    'data-fv-regexp' => 'true',
                                    'data-fv-regexp-regexp' => self::___CLASS_REGEX_MINIMAL___,
                                    'data-fv-regexp-message' => 'Texto contiene caracteres no permitidos',
                            )
            ))
            ->add('direccion', 'textarea', array(
                            'label' => 'Dirección / Domicilio',
                            'label_attr' => array('class' => 'label_form_sm'),
                            'required' => false,
                            'attr' => array(
                                    'rows' => '2',
                                    'style' => 'resize:none',
                                    'placeholder' => 'domicilio...',
                                    'class' => 'form-control input-sm',

                                    'data-fv-stringlength' => 'true',
                                    'data-fv-stringlength-min' => '5',
                                    'data-fv-stringlength-message' => '5 caracteres mínimo',

                                    'data-fv-regexp' => 'true',
                                    'data-fv-regexp-regexp' => self::___CLASS_REGEX_EXTENDED___,
                                    'data-fv-regexp-message' => 'Texto contiene caracteres no permitidos',
                            )
            ))
            ->add('idOcupacion', null, array(
                            'label' => 'Ocupación',
                            'label_attr' => array('class' => 'label_form_sm'),
                            'required' => false,
                            'attr' => array(
                                    'class' => 'form-control input-sm',
                                    // 'data-form-inline-group' => 'start',
                                    'data-add-form-group-col-class' => 'col-lg-4 col-md-4 col-sm-4',

                                    'data-add-input-addon' => 'true',
                                    // 'data-add-input-addon-class' => 'primary-v4',
                                    'data-add-input-addon-addon' => 'glyphicon glyphicon-wrench',
                            )
            ))
            // ->add('ocupacion', null, array(
            //                 'label' => 'Ocupación',
            //                 'label_attr' => array('class' => 'label_form_sm'),
            //                 'attr' => array(
            //                         'placeholder' => 'ocupación...',
            //                         'class' => 'form-control input-sm',
            //                         // 'data-form-inline-group' => 'stop',
            //                         'data-add-form-group-col-class' => 'col-lg-4 col-md-4 col-sm-4',

            //                         'data-add-input-addon' => 'true',
            //                         // 'data-add-input-addon-class' => 'primary-v4',
            //                         'data-add-input-addon-addon' => 'glyphicon glyphicon-user',

            //                         'data-fv-stringlength' => 'true',
            //                         'data-fv-stringlength-min' => '1',
            //                         'data-fv-stringlength-message' => '1 caracter mínimo',

            //                         'data-fv-regexp' => 'true',
            //                         'data-fv-regexp-regexp' => self::___CLASS_REGEX_MINIMAL___,
            //                         'data-fv-regexp-message' => 'Texto contiene caracteres no permitidos',
            //                 )
            // ))
            ->add('idEstadoCivil', null, array(
                            'label' => 'Estado civil',
                            'label_attr' => array('class' => 'label_form_sm'),
                            'required' => false,
                            'attr' => array(
                                    'class' => 'form-control input-sm',
                                    // 'data-form-inline-group' => 'start',
                                    'data-add-form-group-col-class' => 'col-lg-4 col-md-4 col-sm-4',

                                    'data-add-input-addon' => 'true',
                                    // 'data-add-input-addon-class' => 'primary-v4',
                                    'data-add-input-addon-addon' => 'glyphicon glyphicon-link',
                            )
            ))
            // ->add('estadoCivil', null, array(
            //                 'label' => 'Estado civil',
            //                 'label_attr' => array('class' => 'label_form_sm'),
            //                 'attr' => array(
            //                         'placeholder' => 'estado civil...',
            //                         'class' => 'form-control input-sm',
            //                         // 'data-form-inline-group' => 'stop',
            //                         'data-add-form-group-col-class' => 'col-lg-4 col-md-4 col-sm-4',

            //                         'data-add-input-addon' => 'true',
            //                         // 'data-add-input-addon-class' => 'primary-v4',
            //                         'data-add-input-addon-addon' => 'glyphicon glyphicon-user',

            //                         'data-fv-stringlength' => 'true',
            //                         'data-fv-stringlength-min' => '1',
            //                         'data-fv-stringlength-message' => '1 caracter mínimo',

            //                         'data-fv-regexp' => 'true',
            //                         'data-fv-regexp-regexp' => self::___CLASS_REGEX_MINIMAL___,
            //                         'data-fv-regexp-message' => 'Texto contiene caracteres no permitidos',
            //                 )
            // ))
            ->add('idEscolaridad', null, array(
                            'label' => 'Escolaridad',
                            'label_attr' => array('class' => 'label_form_sm'),
                            'required' => false,
                            'attr' => array(
                                    'class' => 'form-control input-sm',
                                    // 'data-form-inline-group' => 'start',
                                    'data-add-form-group-col-class' => 'col-lg-4 col-md-4 col-sm-4',

                                    'data-add-input-addon' => 'true',
                                    // 'data-add-input-addon-class' => 'primary-v4',
                                    'data-add-input-addon-addon' => 'glyphicon glyphicon-user',
                            )
            ))
            // ->add('escolaridad', null, array(
            //                 'label' => 'Escolaridad',
            //                 'label_attr' => array('class' => 'label_form_sm'),
            //                 'attr' => array(
            //                         'placeholder' => 'escolaridad...',
            //                         'class' => 'form-control input-sm',
            //                         // 'data-form-inline-group' => 'stop',
            //                         'data-add-form-group-col-class' => 'col-lg-4 col-md-4 col-sm-4',

            //                         'data-add-input-addon' => 'true',
            //                         // 'data-add-input-addon-class' => 'primary-v4',
            //                         'data-add-input-addon-addon' => 'glyphicon glyphicon-barcode',

            //                         'data-fv-stringlength' => 'true',
            //                         'data-fv-stringlength-min' => '1',
            //                         'data-fv-stringlength-message' => '1 caracter mínimo',

            //                         'data-fv-regexp' => 'true',
            //                         'data-fv-regexp-regexp' => self::___CLASS_REGEX_MINIMAL___,
            //                         'data-fv-regexp-message' => 'Texto contiene caracteres no permitidos',
            //                 )
            // ))
            ->add('observaciones', 'textarea', array(
                            'label' => 'Observaciones / Comentarios',
                            'label_attr' => array('class' => 'label_form_sm'),
                            'required' => false,
                            'attr' => array(
                                    'rows' => '2',
                                    'style' => 'resize:none',
                                    'placeholder' => 'comentarios...',
                                    'class' => 'form-control input-sm',

                                    'data-fv-stringlength' => 'true',
                                    'data-fv-stringlength-min' => '5',
                                    'data-fv-stringlength-message' => '5 caracteres mínimo',

                                    'data-fv-regexp' => 'true',
                                    'data-fv-regexp-regexp' => self::___CLASS_REGEX_EXTENDED___,
                                    'data-fv-regexp-message' => 'Texto contiene caracteres no permitidos',
                            )
            ))
            ->add('idTipoColecta', null, array(
                            'label' => 'Tipo de colecta',
                            'label_attr' => array('class' => 'label_form_sm'),
                            'required' => false,
                            'attr' => array(
                                    'class' => 'form-control input-sm',
                                    // 'data-form-inline-group' => 'start',
                                    'data-add-form-group-col-class' => 'col-lg-4 col-md-4 col-sm-4',

                                    'data-add-input-addon' => 'true',
                                    // 'data-add-input-addon-class' => 'primary-v4',
                                    'data-add-input-addon-addon' => 'glyphicon glyphicon-pushpin',
                            )
            ))
            // ->add('tipoColecta', null, array(
            //                 'label' => 'Tipo de colecta',
            //                 'label_attr' => array('class' => 'label_form_sm'),
            //                 'attr' => array(
            //                         'placeholder' => 'tipo de colecta...',
            //                         'class' => 'form-control input-sm',
            //                         // 'data-form-inline-group' => 'stop',
            //                         // 'data-add-form-group-col-class' => 'col-lg-4 col-md-4 col-sm-4',

            //                         'data-add-input-addon' => 'true',
            //                         // 'data-add-input-addon-class' => 'primary-v4',
            //                         'data-add-input-addon-addon' => 'glyphicon glyphicon-barcode',

            //                         'data-fv-stringlength' => 'true',
            //                         'data-fv-stringlength-min' => '1',
            //                         'data-fv-stringlength-message' => '1 caracter mínimo',

            //                         'data-fv-regexp' => 'true',
            //                         'data-fv-regexp-regexp' => self::___CLASS_REGEX_MINIMAL___,
            //                         'data-fv-regexp-message' => 'Texto contiene caracteres no permitidos',
            //                 )
            // ))
            // ->add('estado', null, array(
            //                 'label' => 'Estado',
            //                 'label_attr' => array('class' => 'label_form_sm'),
            //                 'attr' => array(
            //                         'placeholder' => 'estado...',
            //                         'class' => 'form-control input-sm',
            //                         // 'data-form-inline-group' => 'stop',
            //                         // 'data-add-form-group-col-class' => 'col-lg-4 col-md-4 col-sm-4',

            //                         'data-add-input-addon' => 'true',
            //                         // 'data-add-input-addon-class' => 'primary-v4',
            //                         'data-add-input-addon-addon' => 'glyphicon glyphicon-hearth',

            //                         'data-fv-stringlength' => 'true',
            //                         'data-fv-stringlength-min' => '1',
            //                         'data-fv-stringlength-message' => '1 caracter mínimo',

            //                         'data-fv-regexp' => 'true',
            //                         'data-fv-regexp-regexp' => self::___CLASS_REGEX_MINIMAL___,
            //                         'data-fv-regexp-message' => 'Texto contiene caracteres no permitidos',
            //                 )
            // ))
            ->add('activo', null, array(
                            'label' => '¿Activo?',
                            'label_attr' => array('class' => 'label_form_sm label_check col-lg-12 col-md-12 col-sm-12'),
                            'attr' => array(
                                    'class' => 'form-control input-sm',
                                    // 'data-form-inline-group' => 'start',
                                    // 'data-add-form-group-col-class' => 'col-lg-1 col-md-1 col-sm-1',
                            )
            ))
            // ->add('usuario')
            // ->add('fechaHoraReg')
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            // ->add('id')
            ->add('codigoDonante')
            ->add('primerNombre')
            ->add('segundoNombre')
            ->add('primerApellido')
            ->add('segundoApellido')
            ->add('fechaNacimiento')
            ->add('fechaRegistroDonanteBlh')
            ->add('telefonoFijo')
            ->add('telefonoMovil')
            ->add('direccion')
            ->add('procedencia')
            ->add('registro')
            ->add('numeroDocumentoIdentificacion')
            ->add('documentoIdentificacion')
            ->add('edad')
            ->add('ocupacion')
            ->add('estadoCivil')
            ->add('escolaridad')
            ->add('tipoColecta')
            ->add('observaciones')
            ->add('estado')
            // ->add('usuario')
            // ->add('fechaHoraReg')
        ;
    }

}