<?php

namespace SanRafael\RequerimientosBundle\Admin;

//use Sonata\AdminBundle\Admin\Admin;
use SanRafael\RequerimientosBundle\Admin\SanRafaelRequerimientosAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
//use Doctrine\ORM\EntityRepository;
//use Sonata\AdminBundle\Validator\ErrorElement;
//use Sonata\AdminBundle\Route\RouteCollection;

class ReqCtlAreaAtencionAdmin extends SanRafaelRequerimientosAdmin
{
    protected $baseRouteName    = 'sigereq_area_atencion';
    protected $baseRoutePattern = 'catalogo/area-atencion';

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('nombre')
            ->add('codigo')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('nombre')
            ->add('codigo')
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
        $MAIN_BOX_LABEL = 'Nuevo registro';
        $admin_subject  = $this->getSubject();
        if ($this->id($admin_subject)) {
            $MAIN_BOX_LABEL = 'Editar registro';
        }

        $formMapper
            ->with($MAIN_BOX_LABEL, array('class' => 'col-lg-12 col-md-12 col-sm-12', 'description' => ''))
                // ->add('id')
                ->add('nombre', null, array(
                                        'label' => 'Nombre',
                                        'label_attr' => array('class' => 'label_form_sm'),
                                        'attr' => array(/*'maxlength' => '100',*/
                                                        'placeholder' => 'Nombre para el registro',
                                                        'data-add-form-group-col' => 'true',
                                                        'data-add-form-group-col-class' => 'col-lg-6 col-md-6 col-sm-6',
                                                        'class' => 'input-sm',

                                                        'data-add-input-addon' => 'true',
                                                        'data-add-input-addon-class' => 'primary-v4',
                                                        'data-add-input-addon-addon' => 'glyphicon glyphicon-edit',

                                                        'data-fv-stringlength' => 'true',
                                                        'data-fv-stringlength-min' => '5',
                                                        'data-fv-stringlength-max' => '100',
                                                        'data-fv-stringlength-message' => '5 caracteres mínimo',

                                                        'data-fv-regexp' => 'true',
                                                        'data-fv-regexp-regexp' => '^[a-zA-ZüÜñÑáéíóúÁÉÍÓÚ0-9¿!¡;,:\.\?#@()_-\s]+$',
                                                        'data-fv-regexp-message' => 'Texto contiene caracteres no permitidos',
                                        )
                ))
                ->add('codigo', null, array(
                                        'label' => 'Código',
                                        'label_attr' => array('class' => 'label_form_sm'),
                                        // 'help' => '',
                                        'attr' => array(/*'maxlength' => '10',*/
                                                        'placeholder' => 'Código',
                                                        'data-add-form-group-col' => 'true',
                                                        'data-add-form-group-col-class' => 'col-lg-4 col-md-4 col-sm-4',
                                                        'class' => 'form-control input-sm',

                                                        'data-add-input-addon' => 'true',
                                                        'data-add-input-addon-class' => 'primary-v4',
                                                        'data-add-input-addon-addon' => 'glyphicon glyphicon-barcode',
                                            
                                                        'data-fv-stringlength' => 'true',
                                                        'data-fv-stringlength-min' => '2',
                                                        'data-fv-stringlength-max' => '10',
                                                        'data-fv-stringlength-message' => '2 caracteres mínimo',

                                                        'data-fv-regexp' => 'true',
                                                        'data-fv-regexp-regexp' => '^[a-zA-Z0-9_-]+$',
                                                        'data-fv-regexp-message' => 'Texto contiene caracteres no permitidos',
                                        )
                ))
            ->end()
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('nombre')
            ->add('codigo')
        ;
    }

    public function prePersist($entity)
    {
        if ($entity->getCodigo())
        {
            $entity->setCodigo(strtoupper($entity->getCodigo()));
        }
    }
    
    public function preUpdate($entity)
    {
        if ($entity->getCodigo())
        {
            $entity->setCodigo(strtoupper($entity->getCodigo()));
        }
    }

}