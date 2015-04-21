<?php
/*
*   Oasis - Sistema de Gestión para Recursos Humanos
*   Empresa Estatal de Transporte por Cable "Mi Teleférico"
*   Versión:  1.0.0
*   Usuario Creador: Lic. Javier Loza
*   Fecha Creación:  13-03-2015
*/

class HorariosymarcacionesController extends ControllerBase
{
    public function initialize()
    {
        parent::initialize();
    }
    /**
     * Función para la carga de la página de gestión de relaciones laborales.
     * Se cargan los combos necesarios.
     */
    public function indexAction()
    {
        $this->assets->addCss('/assets/css/bootstrap-switch.css');
        $this->assets->addJs('/js/switch/bootstrap-switch.js');
        $this->assets->addCss('/assets/css/oasis.principal.css');
        $this->assets->addCss('/assets/css/jquery-ui.css');
        $this->assets->addCss('/css/oasis.grillas.css');
        $this->assets->addJs('/js/numeric/jquery.numeric.js');
        $this->assets->addJs('/js/jquery.PrintArea.js');
        $this->assets->addCss('/assets/css/PrintArea.css');

        $this->assets->addCss('/assets/css/clockpicker.css');
        $this->assets->addJs('/js/clockpicker/clockpicker.js');

        $this->assets->addJs('/js/horariosymarcaciones/oasis.horariosymarcaciones.tab.js');
        $this->assets->addJs('/js/horariosymarcaciones/oasis.horariosymarcaciones.index.js');
        $this->assets->addJs('/js/horariosymarcaciones/oasis.horariosymarcaciones.list.js');
        $this->assets->addJs('/js/horariosymarcaciones/oasis.horariosymarcaciones.approve.js');
        $this->assets->addJs('/js/horariosymarcaciones/oasis.horariosymarcaciones.calculations.js');
        $this->assets->addJs('/js/horariosymarcaciones/oasis.horariosymarcaciones.new.edit.js');
        $this->assets->addJs('/js/horariosymarcaciones/oasis.horariosymarcaciones.turns.excepts.js');
        $this->assets->addJs('/js/horariosymarcaciones/oasis.horariosymarcaciones.down.js');
        $this->assets->addJs('/js/horariosymarcaciones/oasis.horariosymarcaciones.move.js');
        $this->assets->addJs('/js/horariosymarcaciones/oasis.horariosymarcaciones.view.js');
        $this->assets->addJs('/js/horariosymarcaciones/oasis.horariosymarcaciones.export.marc.js');
        $this->assets->addJs('/js/horariosymarcaciones/oasis.horariosymarcaciones.export.calc.js');
        $this->assets->addJs('/js/horariosymarcaciones/oasis.horariosymarcaciones.view.splitter.js');
    }
    /**
     * Función para la obtención del listado de registros de control de marcaciones.
     */
    public function listporrelaboralAction()
    {
        $this->view->disable();
        $horariosymarcaciones = Array();
        if(isset($_GET["id"])&&$_GET["id"]>0){
            $obj = new Fhorariosymarcaciones();
            $idRelaboral = $_GET["id"];
            $resul = $obj->getAll("WHERE relaboral_id=".$idRelaboral);
            //comprobamos si hay filas
            if ($resul->count() > 0) {
                foreach ($resul as $v) {
                        $horariosymarcaciones[] = array(
                            'nro_row' => 0,
                            'id'=>$v->id_horarioymarcacion,
                            'relaboral_id'=>$v->relaboral_id,
                            'gestion'=>$v->gestion,
                            'mes'=>$v->mes,
                            'mes_nombre'=>$v->mes_nombre,
                            'turno'=>$v->turno,
                            'grupo'=>$v->grupo,
                            'clasemarcacion'=>$v->clasemarcacion,
                            'clasemarcacion_descripcion'=>$v->clasemarcacion_descripcion,
                            'modalidadmarcacion_id'=>$v->modalidadmarcacion_id,
                            'modalidad_marcacion'=>$v->modalidad_marcacion,
                            'd1'=>$v->d1,
                            'calendariolaboral1_id'=>$v->calendariolaboral1_id,
                            'd2'=>$v->d2,
                            'calendariolaboral2_id'=>$v->calendariolaboral2_id,
                            'd3'=>$v->d3,
                            'calendariolaboral3_id'=>$v->calendariolaboral3_id,
                            'd4'=>$v->d4,
                            'calendariolaboral4_id'=>$v->calendariolaboral4_id,
                            'd5'=>$v->d5,
                            'calendariolaboral5_id'=>$v->calendariolaboral5_id,
                            'd6'=>$v->d6,
                            'calendariolaboral6_id'=>$v->calendariolaboral6_id,
                            'd7'=>$v->d7,
                            'calendariolaboral7_id'=>$v->calendariolaboral7_id,
                            'd8'=>$v->d8,
                            'calendariolaboral8_id'=>$v->calendariolaboral8_id,
                            'd9'=>$v->d9,
                            'calendariolaboral9_id'=>$v->calendariolaboral9_id,
                            'd10'=>$v->d10,
                            'calendariolaboral10_id'=>$v->calendariolaboral10_id,
                            'd11'=>$v->d11,
                            'calendariolaboral11_id'=>$v->calendariolaboral11_id,
                            'd12'=>$v->d12,
                            'calendariolaboral12_id'=>$v->calendariolaboral12_id,
                            'd13'=>$v->d13,
                            'calendariolaboral13_id'=>$v->calendariolaboral13_id,
                            'd14'=>$v->d14,
                            'calendariolaboral14_id'=>$v->calendariolaboral14_id,
                            'd15'=>$v->d15,
                            'calendariolaboral15_id'=>$v->calendariolaboral15_id,
                            'd16'=>$v->d16,
                            'calendariolaboral16_id'=>$v->calendariolaboral16_id,
                            'd17'=>$v->d17,
                            'calendariolaboral17_id'=>$v->calendariolaboral17_id,
                            'd18'=>$v->d18,
                            'calendariolaboral18_id'=>$v->calendariolaboral18_id,
                            'd19'=>$v->d19,
                            'calendariolaboral19_id'=>$v->calendariolaboral19_id,
                            'd20'=>$v->d20,
                            'calendariolaboral20_id'=>$v->calendariolaboral20_id,
                            'd21'=>$v->d21,
                            'calendariolaboral21_id'=>$v->calendariolaboral21_id,
                            'd22'=>$v->d22,
                            'calendariolaboral22_id'=>$v->calendariolaboral22_id,
                            'd23'=>$v->d23,
                            'calendariolaboral23_id'=>$v->calendariolaboral23_id,
                            'd24'=>$v->d24,
                            'calendariolaboral24_id'=>$v->calendariolaboral24_id,
                            'd25'=>$v->d25,
                            'calendariolaboral25_id'=>$v->calendariolaboral25_id,
                            'd26'=>$v->d26,
                            'calendariolaboral26_id'=>$v->calendariolaboral26_id,
                            'd27'=>$v->d27,
                            'calendariolaboral27_id'=>$v->calendariolaboral27_id,
                            'd28'=>$v->d28,
                            'calendariolaboral28_id'=>$v->calendariolaboral28_id,
                            'd29'=>$v->d29,
                            'calendariolaboral29_id'=>$v->calendariolaboral29_id,
                            'd30'=>$v->d30,
                            'calendariolaboral30_id'=>$v->calendariolaboral30_id,
                            'd31'=>$v->d31,
                            'calendariolaboral31_id'=>$v->calendariolaboral31_id,
                            'ultimo_dia'=>$v->ultimo_dia,
                            'atrasos'=>$v->atrasos,
                            'faltas'=>$v->faltas,
                            'abandono'=>$v->abandono,
                            'omision'=>$v->omision,
                            'lsgh'=>$v->lsgh,
                            'compensacion'=>$v->compensacion,
                            'observacion'=>$v->observacion,
                            'estado'=>$v->estado,
                            'estado_descripcion'=>$v->estado_descripcion,
                            'baja_logica'=>$v->baja_logica,
                            'agrupador'=>$v->agrupador,
                            'user_reg_id'=>$v->user_reg_id,
                            'fecha_reg'=>$v->fecha_reg,
                            'user_apr_id'=>$v->user_apr_id,
                            'fecha_apr'=>$v->fecha_apr,
                            'user_mod_id'=>$v->user_mod_id,
                            'fecha_mod'=>$v->fecha_mod,
                        );
                    #region sector para adicionar una fila para Excepciones
                    if($v->modalidadmarcacion_id==6){
                        $d1=$d2=$d3=$d4=$d5=$d6=$d7=$d8=$d9=$d10=$d11=$d12=$d13=$d14=$d15=$d16=$d17=$d18=$d19=$d20=$d21=$d22=$d23=$d24=$d25=$d26=$d27=$d28=$d29=$d30=$d30=$d31="";
                        if($v->calendariolaboral1_id>0){
                            $res1 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,1,$v->calendariolaboral1_id);
                            if(is_object($res1)&&$res1->count()>0){
                                foreach($res1 as $r1){
                                    $d1 = $r1->f_excepciones_en_dia;
                                }
                            }
                        }
                        if($v->calendariolaboral2_id>0){
                            $res2 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,2,$v->calendariolaboral2_id);
                            if(is_object($res2)&&$res2->count()>0){
                                foreach($res2 as $r2){
                                    $d2 = $r2->f_excepciones_en_dia;
                                }

                            }
                        }
                        if($v->calendariolaboral3_id>0){
                            $res3 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,3,$v->calendariolaboral3_id);
                            if(is_object($res3)&&$res3->count()>0){
                                foreach($res3 as $r3){
                                    $d3 = $r3->f_excepciones_en_dia;
                                }

                            }
                        }

                        if($v->calendariolaboral4_id>0){
                            $res4 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,4,$v->calendariolaboral4_id);
                            if(is_object($res4)&&$res4->count()>0){
                                foreach($res4 as $r4){
                                    $d4 = $r4->f_excepciones_en_dia;
                                }

                            }
                        }
                        if($v->calendariolaboral5_id>0){
                            $res5 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,5,$v->calendariolaboral5_id);
                            if(is_object($res5)&&$res5->count()>0){
                                foreach($res5 as $r5){
                                    $d5 = $r5->f_excepciones_en_dia;
                                }

                            }
                        }
                        if($v->calendariolaboral6_id>0){
                            $res6 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,6,$v->calendariolaboral6_id);
                            if(is_object($res6)&&$res6->count()>0){
                                foreach($res6 as $r6){
                                    $d6 = $r6->f_excepciones_en_dia;
                                }

                            }
                        }
                        if($v->calendariolaboral7_id>0){
                            $res7 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,7,$v->calendariolaboral7_id);
                            if(is_object($res7)&&$res7->count()>0){
                                foreach($res7 as $r7){
                                    $d7 = $r7->f_excepciones_en_dia;
                                }

                            }
                        }
                        if($v->calendariolaboral8_id>0){
                            $res8 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,8,$v->calendariolaboral8_id);
                            if(is_object($res8)&&$res8->count()>0){
                                foreach($res8 as $r8){
                                    $d8 = $r8->f_excepciones_en_dia;
                                }

                            }
                        }
                        if($v->calendariolaboral9_id>0){
                            $res9 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,9,$v->calendariolaboral9_id);
                            if(is_object($res9)&&$res9->count()>0){
                                foreach($res9 as $r9){
                                    $d9 = $r9->f_excepciones_en_dia;
                                }

                            }
                        }
                        if($v->calendariolaboral10_id>0){
                            $res10 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,10,$v->calendariolaboral10_id);
                            if(is_object($res10)&&$res10->count()>0){
                                foreach($res10 as $r10){
                                    $d10 = $r10->f_excepciones_en_dia;
                                }

                            }
                        }
                        if($v->calendariolaboral11_id>0){
                            $res11 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,11,$v->calendariolaboral11_id);
                            if(is_object($res11)&&$res11->count()>0){
                                foreach($res11 as $r11){
                                    $d11 = $r11->f_excepciones_en_dia;
                                }

                            }
                        }
                        if($v->calendariolaboral12_id>0){
                            $res12 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,12,$v->calendariolaboral12_id);
                            if(is_object($res12)&&$res12->count()>0){
                                foreach($res12 as $r12){
                                    $d12 = $r12->f_excepciones_en_dia;
                                }

                            }
                        }

                        if($v->calendariolaboral13_id>0){
                            $res13 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,13,$v->calendariolaboral13_id);
                            if(is_object($res13)&&$res13->count()>0){
                                foreach($res13 as $r13){
                                    $d13 = $r13->f_excepciones_en_dia;
                                }

                            }
                        }

                        if($v->calendariolaboral14_id>0){
                            $res14 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,14,$v->calendariolaboral14_id);
                            if(is_object($res14)&&$res14->count()>0){
                                foreach($res14 as $r14){
                                    $d14 = $r14->f_excepciones_en_dia;
                                }

                            }
                        }
                        if($v->calendariolaboral15_id>0){
                            $res15 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,15,$v->calendariolaboral15_id);
                            if(is_object($res15)&&$res15->count()>0){
                                foreach($res15 as $r15){
                                    $d15 = $r15->f_excepciones_en_dia;
                                }

                            }
                        }
                        if($v->calendariolaboral16_id>0){
                            $res16 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,16,$v->calendariolaboral16_id);
                            if(is_object($res16)&&$res16->count()>0){
                                foreach($res16 as $r16){
                                    $d16 = $r16->f_excepciones_en_dia;
                                }

                            }
                        }
                        if($v->calendariolaboral17_id>0){
                            $res17 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,17,$v->calendariolaboral17_id);
                            if(is_object($res17)&&$res17->count()>0){
                                foreach($res17 as $r17){
                                    $d17 = $r17->f_excepciones_en_dia;
                                }

                            }
                        }
                        if($v->calendariolaboral18_id>0){
                            $res18 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,18,$v->calendariolaboral18_id);
                            if(is_object($res18)&&$res18->count()>0){
                                foreach($res18 as $r){
                                    $d18 = $r->f_excepciones_en_dia;
                                }

                            }
                        }
                        if($v->calendariolaboral19_id>0){
                            $res19 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,19,$v->calendariolaboral19_id);
                            if(is_object($res19)&&$res19->count()>0){
                                foreach($res19 as $r){
                                    $d19 = $r->f_excepciones_en_dia;
                                }

                            }
                        }
                        if($v->calendariolaboral20_id>0){
                            $res20 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,20,$v->calendariolaboral20_id);
                            if(is_object($res20)&&$res20->count()>0){
                                foreach($res20 as $r){
                                    $d20 = $r->f_excepciones_en_dia;
                                }

                            }
                        }
                        if($v->calendariolaboral21_id>0){
                            $res21 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,21,$v->calendariolaboral21_id);
                            if(is_object($res21)&&$res21->count()>0){
                                foreach($res21 as $r21){
                                    $d21 = $r21->f_excepciones_en_dia;
                                }

                            }
                        }
                        if($v->calendariolaboral22_id>0){
                            $res22 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,22,$v->calendariolaboral22_id);
                            if(is_object($res22)&&$res22->count()>0){
                                foreach($res22 as $r22){
                                    $d22 = $r22->f_excepciones_en_dia;
                                }

                            }
                        }
                        if($v->calendariolaboral23_id>0){
                            $res23 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,23,$v->calendariolaboral23_id);
                            if(is_object($res23)&&$res23->count()>0){
                                foreach($res23 as $r23){
                                    $d23 = $r23->f_excepciones_en_dia;
                                }

                            }
                        }
                        if($v->calendariolaboral24_id>0){
                            $res24 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,24,$v->calendariolaboral24_id);
                            if(is_object($res24)&&$res24->count()>0){
                                foreach($res24 as $r24){
                                    $d24 = $r24->f_excepciones_en_dia;
                                }

                            }
                        }
                        if($v->calendariolaboral25_id>0){
                            $res25 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,25,$v->calendariolaboral25_id);
                            if(is_object($res25)&&$res25->count()>0){
                                foreach($res25 as $r25){
                                    $d25 = $r25->f_excepciones_en_dia;
                                }

                            }
                        }
                        if($v->calendariolaboral26_id>0){
                            $res26 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,26,$v->calendariolaboral26_id);
                            if(is_object($res26)&&$res26->count()>0){
                                foreach($res26 as $r26){
                                    $d26 = $r26->f_excepciones_en_dia;
                                }

                            }
                        }
                        if($v->calendariolaboral27_id>0){
                            $res27 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,27,$v->calendariolaboral27_id);
                            if(is_object($res27)&&$res27->count()>0){
                                foreach($res27 as $r27){
                                    $d27 = $r27->f_excepciones_en_dia;
                                }

                            }
                        }
                        if($v->calendariolaboral28_id>0){
                            $res28 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,28,$v->calendariolaboral28_id);
                            if(is_object($res28)&&$res28->count()>0){
                                foreach($res28 as $r28){
                                    $d28 = $r28->f_excepciones_en_dia;
                                }

                            }
                        }
                        if($v->calendariolaboral29_id>0){
                            $res29 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,29,$v->calendariolaboral29_id);
                            if(is_object($res29)&&$res29->count()>0){
                                foreach($res29 as $r29){
                                    $d29 = $r29->f_excepciones_en_dia;
                                }

                            }
                        }
                        if($v->calendariolaboral30_id>0){
                            $res30 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,30,$v->calendariolaboral30_id);
                            if(is_object($res30)&&$res30->count()>0){
                                foreach($res30 as $r30){
                                    $d30 = $r30->f_excepciones_en_dia;
                                }

                            }
                        }
                        if($v->calendariolaboral31_id>0){
                            $res31 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,31,$v->calendariolaboral31_id);
                            if(is_object($res31)&&$res31->count()>0){
                                foreach($res31 as $r31){
                                    $d31 = $r31->f_excepciones_en_dia;
                                }

                            }
                        }
                        $horariosymarcaciones[] = array(
                            'nro_row' => 0,
                            'id'=>$v->id_horarioymarcacion,
                            'relaboral_id'=>$v->relaboral_id,
                            'gestion'=>$v->gestion,
                            'mes'=>$v->mes,
                            'mes_nombre'=>$v->mes_nombre,
                            'turno'=>$v->turno,
                            'grupo'=>$v->grupo,
                            'clasemarcacion'=>"e",
                            'clasemarcacion_descripcion'=>"EXCEPCIONES",
                            'modalidadmarcacion_id'=>$v->modalidadmarcacion_id,
                            'modalidad_marcacion'=>"EXCEPCIONES",
                            'd1'=>$d1,
                            'calendariolaboral1_id'=>$v->calendariolaboral1_id,
                            'd2'=>$d2,
                            'calendariolaboral2_id'=>$v->calendariolaboral2_id,
                            'd3'=>$d3,
                            'calendariolaboral3_id'=>$v->calendariolaboral3_id,
                            'd4'=>$d4,
                            'calendariolaboral4_id'=>$v->calendariolaboral4_id,
                            'd5'=>$d5,
                            'calendariolaboral5_id'=>$v->calendariolaboral5_id,
                            'd6'=>$d6,
                            'calendariolaboral6_id'=>$v->calendariolaboral6_id,
                            'd7'=>$d7,
                            'calendariolaboral7_id'=>$v->calendariolaboral7_id,
                            'd8'=>$d8,
                            'calendariolaboral8_id'=>$v->calendariolaboral8_id,
                            'd9'=>$d9,
                            'calendariolaboral9_id'=>$v->calendariolaboral9_id,
                            'd10'=>$d10,
                            'calendariolaboral10_id'=>$v->calendariolaboral10_id,
                            'd11'=>$d11,
                            'calendariolaboral11_id'=>$v->calendariolaboral11_id,
                            'd12'=>$d12,
                            'calendariolaboral12_id'=>$v->calendariolaboral12_id,
                            'd13'=>$d13,
                            'calendariolaboral13_id'=>$v->calendariolaboral13_id,
                            'd14'=>$d14,
                            'calendariolaboral14_id'=>$v->calendariolaboral14_id,
                            'd15'=>$d15,
                            'calendariolaboral15_id'=>$v->calendariolaboral15_id,
                            'd16'=>$d16,
                            'calendariolaboral16_id'=>$v->calendariolaboral16_id,
                            'd17'=>$d17,
                            'calendariolaboral17_id'=>$v->calendariolaboral17_id,
                            'd18'=>$d18,
                            'calendariolaboral18_id'=>$v->calendariolaboral18_id,
                            'd19'=>$d19,
                            'calendariolaboral19_id'=>$v->calendariolaboral19_id,
                            'd20'=>$d20,
                            'calendariolaboral20_id'=>$v->calendariolaboral20_id,
                            'd21'=>$d21,
                            'calendariolaboral21_id'=>$v->calendariolaboral21_id,
                            'd22'=>$d22,
                            'calendariolaboral22_id'=>$v->calendariolaboral22_id,
                            'd23'=>$d23,
                            'calendariolaboral23_id'=>$v->calendariolaboral23_id,
                            'd24'=>$d24,
                            'calendariolaboral24_id'=>$v->calendariolaboral24_id,
                            'd25'=>$d25,
                            'calendariolaboral25_id'=>$v->calendariolaboral25_id,
                            'd26'=>$d26,
                            'calendariolaboral26_id'=>$v->calendariolaboral26_id,
                            'd27'=>$d27,
                            'calendariolaboral27_id'=>$v->calendariolaboral27_id,
                            'd28'=>$d28,
                            'calendariolaboral28_id'=>$v->calendariolaboral28_id,
                            'd29'=>$d29,
                            'calendariolaboral29_id'=>$v->calendariolaboral29_id,
                            'd30'=>$d30,
                            'calendariolaboral30_id'=>$v->calendariolaboral30_id,
                            'd31'=>$d31,
                            'calendariolaboral31_id'=>$v->calendariolaboral31_id,
                            'ultimo_dia'=>$v->ultimo_dia,
                            'atrasos'=>null,
                            'faltas'=>null,
                            'abandono'=>null,
                            'omision'=>null,
                            'compensacion'=>null,
                            'observacion'=>$v->observacion,
                            'estado'=>$v->estado,
                            'estado_descripcion'=>$v->estado_descripcion,
                            'baja_logica'=>$v->baja_logica,
                            'agrupador'=>$v->agrupador,
                            'user_reg_id'=>$v->user_reg_id,
                            'fecha_reg'=>$v->fecha_reg,
                            'user_apr_id'=>$v->user_apr_id,
                            'fecha_apr'=>$v->fecha_apr,
                            'user_mod_id'=>$v->user_mod_id,
                            'fecha_mod'=>$v->fecha_mod,
                        );
                    }
                    #endregion sector para adicionar una fila para Excepciones
                }
            }
        }
        echo json_encode($horariosymarcaciones);
    }
    /**
     * Función para obtener el listado de marcaciones con los cálculos correspondiente considerando el rango de dos meses
     */
    public function listallbyrangeAction()
    {
        $this->view->disable();
        $horariosymarcaciones = Array();
        if(isset($_GET["fecha_ini"])&&isset($_GET["fecha_fin"])){
            $where = "";
            $idRelaboral = 0;
            $ci = "";
            if(isset($_GET["id_relaboral"])&&$_GET["id_relaboral"]>0)
                $idRelaboral=$_GET["id_relaboral"];
            if(isset($_GET["ci"])&&$_GET["ci"]>0)
                $ci=$_GET["ci"];
            $fechaIni =$_GET["fecha_ini"];
            $fechaFin =$_GET["fecha_fin"];

            $obj = new Frelaboraleshorariosymarcaciones();
            $idRelaboral=0;
            if($ci!=''){
                $where = " WHERE ci='".$ci."'";
            }
            $resul = $obj->getAllByRangeTwoMonth($idRelaboral,$fechaIni,$fechaFin,$where);
            //comprobamos si hay filas
            if ($resul->count() > 0) {
                foreach ($resul as $v) {
                    $horariosymarcaciones[] = array(
                        'nro_row' => 0,
                        #region Columnas de procedimiento f_relaborales()
                        'id_relaboral' => $v->id_relaboral,
                        'id_persona' => $v->id_persona,
                        'p_nombre' => $v->p_nombre,
                        's_nombre' => $v->s_nombre,
                        't_nombre' => $v->t_nombre,
                        'p_apellido' => $v->p_apellido,
                        's_apellido' => $v->s_apellido,
                        'c_apellido' => $v->c_apellido,
                        'nombres' => $v->nombres,
                        'ci' => $v->ci,
                        'expd' => $v->expd,
                        'cargo' => $v->cargo,
                        'sueldo' => str_replace(".00", "", $v->sueldo),
                        'condicion' => $v->condicion,
                        'gerencia_administrativa' => $v->gerencia_administrativa,
                        'departamento_administrativo' => $v->departamento_administrativo,
                        'area' => $v->area,
                        'ubicacion' => $v->ubicacion,
                        #endregion Columnas de procedimiento f_relaborales()

                        'id'=>$v->id_horarioymarcacion,
                        'relaboral_id'=>$v->relaboral_id,
                        'gestion'=>$v->gestion,
                        'mes'=>$v->mes,
                        'mes_nombre'=>$v->mes_nombre,
                        'turno'=>$v->turno,
                        'grupo'=>$v->grupo,
                        'clasemarcacion'=>$v->clasemarcacion,
                        'clasemarcacion_descripcion'=>$v->clasemarcacion_descripcion,
                        'modalidadmarcacion_id'=>$v->modalidadmarcacion_id,
                        'modalidad_marcacion'=>$v->modalidad_marcacion,
                        'd1'=>$v->d1,
                        'calendariolaboral1_id'=>$v->calendariolaboral1_id,
                        'd2'=>$v->d2,
                        'calendariolaboral2_id'=>$v->calendariolaboral2_id,
                        'd3'=>$v->d3,
                        'calendariolaboral3_id'=>$v->calendariolaboral3_id,
                        'd4'=>$v->d4,
                        'calendariolaboral4_id'=>$v->calendariolaboral4_id,
                        'd5'=>$v->d5,
                        'calendariolaboral5_id'=>$v->calendariolaboral5_id,
                        'd6'=>$v->d6,
                        'calendariolaboral6_id'=>$v->calendariolaboral6_id,
                        'd7'=>$v->d7,
                        'calendariolaboral7_id'=>$v->calendariolaboral7_id,
                        'd8'=>$v->d8,
                        'calendariolaboral8_id'=>$v->calendariolaboral8_id,
                        'd9'=>$v->d9,
                        'calendariolaboral9_id'=>$v->calendariolaboral9_id,
                        'd10'=>$v->d10,
                        'calendariolaboral10_id'=>$v->calendariolaboral10_id,
                        'd11'=>$v->d11,
                        'calendariolaboral11_id'=>$v->calendariolaboral11_id,
                        'd12'=>$v->d12,
                        'calendariolaboral12_id'=>$v->calendariolaboral12_id,
                        'd13'=>$v->d13,
                        'calendariolaboral13_id'=>$v->calendariolaboral13_id,
                        'd14'=>$v->d14,
                        'calendariolaboral14_id'=>$v->calendariolaboral14_id,
                        'd15'=>$v->d15,
                        'calendariolaboral15_id'=>$v->calendariolaboral15_id,
                        'd16'=>$v->d16,
                        'calendariolaboral16_id'=>$v->calendariolaboral16_id,
                        'd17'=>$v->d17,
                        'calendariolaboral17_id'=>$v->calendariolaboral17_id,
                        'd18'=>$v->d18,
                        'calendariolaboral18_id'=>$v->calendariolaboral18_id,
                        'd19'=>$v->d19,
                        'calendariolaboral19_id'=>$v->calendariolaboral19_id,
                        'd20'=>$v->d20,
                        'calendariolaboral20_id'=>$v->calendariolaboral20_id,
                        'd21'=>$v->d21,
                        'calendariolaboral21_id'=>$v->calendariolaboral21_id,
                        'd22'=>$v->d22,
                        'calendariolaboral22_id'=>$v->calendariolaboral22_id,
                        'd23'=>$v->d23,
                        'calendariolaboral23_id'=>$v->calendariolaboral23_id,
                        'd24'=>$v->d24,
                        'calendariolaboral24_id'=>$v->calendariolaboral24_id,
                        'd25'=>$v->d25,
                        'calendariolaboral25_id'=>$v->calendariolaboral25_id,
                        'd26'=>$v->d26,
                        'calendariolaboral26_id'=>$v->calendariolaboral26_id,
                        'd27'=>$v->d27,
                        'calendariolaboral27_id'=>$v->calendariolaboral27_id,
                        'd28'=>$v->d28,
                        'calendariolaboral28_id'=>$v->calendariolaboral28_id,
                        'd29'=>$v->d29,
                        'calendariolaboral29_id'=>$v->calendariolaboral29_id,
                        'd30'=>$v->d30,
                        'calendariolaboral30_id'=>$v->calendariolaboral30_id,
                        'd31'=>$v->d31,
                        'calendariolaboral31_id'=>$v->calendariolaboral31_id,
                        'ultimo_dia'=>$v->ultimo_dia,
                        'atrasos'=>$v->atrasos,
                        'faltas'=>$v->faltas,
                        'abandono'=>$v->abandono,
                        'omision'=>$v->omision,
                        'lsgh'=>$v->lsgh,
                        'compensacion'=>$v->compensacion,
                        'estado'=>$v->estado,
                        'estado_descripcion'=>$v->estado_descripcion,
                        'baja_logica'=>$v->baja_logica,
                        'agrupador'=>$v->agrupador,
                        'user_reg_id'=>$v->user_reg_id,
                        'fecha_reg'=>$v->fecha_reg,
                        'user_apr_id'=>$v->user_apr_id,
                        'fecha_apr'=>$v->fecha_apr,
                        'user_mod_id'=>$v->user_mod_id,
                        'fecha_mod'=>$v->fecha_mod,
                    );
                    #region sector para adicionar una fila para Excepciones
                    if($v->modalidadmarcacion_id==6){
                        $d1=$d2=$d3=$d4=$d5=$d6=$d7=$d8=$d9=$d10=$d11=$d12=$d13=$d14=$d15=$d16=$d17=$d18=$d19=$d20=$d21=$d22=$d23=$d24=$d25=$d26=$d27=$d28=$d29=$d30=$d30=$d31="";
                        if($v->calendariolaboral1_id>0){
                            $res1 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,1,$v->calendariolaboral1_id);
                            if(is_object($res1)&&$res1->count()>0){
                                foreach($res1 as $r1){
                                    $d1 = $r1->f_excepciones_en_dia;
                                }
                            }
                        }
                        if($v->calendariolaboral2_id>0){
                            $res2 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,2,$v->calendariolaboral2_id);
                            if(is_object($res2)&&$res2->count()>0){
                                foreach($res2 as $r2){
                                    $d2 = $r2->f_excepciones_en_dia;
                                }

                            }
                        }
                        if($v->calendariolaboral3_id>0){
                            $res3 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,3,$v->calendariolaboral3_id);
                            if(is_object($res3)&&$res3->count()>0){
                                foreach($res3 as $r3){
                                    $d3 = $r3->f_excepciones_en_dia;
                                }

                            }
                        }

                        if($v->calendariolaboral4_id>0){
                            $res4 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,4,$v->calendariolaboral4_id);
                            if(is_object($res4)&&$res4->count()>0){
                                foreach($res4 as $r4){
                                    $d4 = $r4->f_excepciones_en_dia;
                                }

                            }
                        }
                        if($v->calendariolaboral5_id>0){
                            $res5 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,5,$v->calendariolaboral5_id);
                            if(is_object($res5)&&$res5->count()>0){
                                foreach($res5 as $r5){
                                    $d5 = $r5->f_excepciones_en_dia;
                                }

                            }
                        }
                        if($v->calendariolaboral6_id>0){
                            $res6 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,6,$v->calendariolaboral6_id);
                            if(is_object($res6)&&$res6->count()>0){
                                foreach($res6 as $r6){
                                    $d6 = $r6->f_excepciones_en_dia;
                                }

                            }
                        }
                        if($v->calendariolaboral7_id>0){
                            $res7 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,7,$v->calendariolaboral7_id);
                            if(is_object($res7)&&$res7->count()>0){
                                foreach($res7 as $r7){
                                    $d7 = $r7->f_excepciones_en_dia;
                                }

                            }
                        }
                        if($v->calendariolaboral8_id>0){
                            $res8 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,8,$v->calendariolaboral8_id);
                            if(is_object($res8)&&$res8->count()>0){
                                foreach($res8 as $r8){
                                    $d8 = $r8->f_excepciones_en_dia;
                                }

                            }
                        }
                        if($v->calendariolaboral9_id>0){
                            $res9 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,9,$v->calendariolaboral9_id);
                            if(is_object($res9)&&$res9->count()>0){
                                foreach($res9 as $r9){
                                    $d9 = $r9->f_excepciones_en_dia;
                                }

                            }
                        }
                        if($v->calendariolaboral10_id>0){
                            $res10 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,10,$v->calendariolaboral10_id);
                            if(is_object($res10)&&$res10->count()>0){
                                foreach($res10 as $r10){
                                    $d10 = $r10->f_excepciones_en_dia;
                                }

                            }
                        }
                        if($v->calendariolaboral11_id>0){
                            $res11 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,11,$v->calendariolaboral11_id);
                            if(is_object($res11)&&$res11->count()>0){
                                foreach($res11 as $r11){
                                    $d11 = $r11->f_excepciones_en_dia;
                                }

                            }
                        }
                        if($v->calendariolaboral12_id>0){
                            $res12 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,12,$v->calendariolaboral12_id);
                            if(is_object($res12)&&$res12->count()>0){
                                foreach($res12 as $r12){
                                    $d12 = $r12->f_excepciones_en_dia;
                                }

                            }
                        }

                        if($v->calendariolaboral13_id>0){
                            $res13 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,13,$v->calendariolaboral13_id);
                            if(is_object($res13)&&$res13->count()>0){
                                foreach($res13 as $r13){
                                    $d13 = $r13->f_excepciones_en_dia;
                                }

                            }
                        }

                        if($v->calendariolaboral14_id>0){
                            $res14 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,14,$v->calendariolaboral14_id);
                            if(is_object($res14)&&$res14->count()>0){
                                foreach($res14 as $r14){
                                    $d14 = $r14->f_excepciones_en_dia;
                                }

                            }
                        }
                        if($v->calendariolaboral15_id>0){
                            $res15 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,15,$v->calendariolaboral15_id);
                            if(is_object($res15)&&$res15->count()>0){
                                foreach($res15 as $r15){
                                    $d15 = $r15->f_excepciones_en_dia;
                                }

                            }
                        }
                        if($v->calendariolaboral16_id>0){
                            $res16 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,16,$v->calendariolaboral16_id);
                            if(is_object($res16)&&$res16->count()>0){
                                foreach($res16 as $r16){
                                    $d16 = $r16->f_excepciones_en_dia;
                                }

                            }
                        }
                        if($v->calendariolaboral17_id>0){
                            $res17 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,17,$v->calendariolaboral17_id);
                            if(is_object($res17)&&$res17->count()>0){
                                foreach($res17 as $r17){
                                    $d17 = $r17->f_excepciones_en_dia;
                                }

                            }
                        }
                        if($v->calendariolaboral18_id>0){
                            $res18 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,18,$v->calendariolaboral18_id);
                            if(is_object($res18)&&$res18->count()>0){
                                foreach($res18 as $r){
                                    $d18 = $r->f_excepciones_en_dia;
                                }

                            }
                        }
                        if($v->calendariolaboral19_id>0){
                            $res19 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,19,$v->calendariolaboral19_id);
                            if(is_object($res19)&&$res19->count()>0){
                                foreach($res19 as $r){
                                    $d19 = $r->f_excepciones_en_dia;
                                }

                            }
                        }
                        if($v->calendariolaboral20_id>0){
                            $res20 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,20,$v->calendariolaboral20_id);
                            if(is_object($res20)&&$res20->count()>0){
                                foreach($res20 as $r){
                                    $d20 = $r->f_excepciones_en_dia;
                                }

                            }
                        }
                        if($v->calendariolaboral21_id>0){
                            $res21 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,21,$v->calendariolaboral21_id);
                            if(is_object($res21)&&$res21->count()>0){
                                foreach($res21 as $r21){
                                    $d21 = $r21->f_excepciones_en_dia;
                                }

                            }
                        }
                        if($v->calendariolaboral22_id>0){
                            $res22 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,22,$v->calendariolaboral22_id);
                            if(is_object($res22)&&$res22->count()>0){
                                foreach($res22 as $r22){
                                    $d22 = $r22->f_excepciones_en_dia;
                                }

                            }
                        }
                        if($v->calendariolaboral23_id>0){
                            $res23 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,23,$v->calendariolaboral23_id);
                            if(is_object($res23)&&$res23->count()>0){
                                foreach($res23 as $r23){
                                    $d23 = $r23->f_excepciones_en_dia;
                                }

                            }
                        }
                        if($v->calendariolaboral24_id>0){
                            $res24 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,24,$v->calendariolaboral24_id);
                            if(is_object($res24)&&$res24->count()>0){
                                foreach($res24 as $r24){
                                    $d24 = $r24->f_excepciones_en_dia;
                                }

                            }
                        }
                        if($v->calendariolaboral25_id>0){
                            $res25 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,25,$v->calendariolaboral25_id);
                            if(is_object($res25)&&$res25->count()>0){
                                foreach($res25 as $r25){
                                    $d25 = $r25->f_excepciones_en_dia;
                                }

                            }
                        }
                        if($v->calendariolaboral26_id>0){
                            $res26 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,26,$v->calendariolaboral26_id);
                            if(is_object($res26)&&$res26->count()>0){
                                foreach($res26 as $r26){
                                    $d26 = $r26->f_excepciones_en_dia;
                                }

                            }
                        }
                        if($v->calendariolaboral27_id>0){
                            $res27 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,27,$v->calendariolaboral27_id);
                            if(is_object($res27)&&$res27->count()>0){
                                foreach($res27 as $r27){
                                    $d27 = $r27->f_excepciones_en_dia;
                                }

                            }
                        }
                        if($v->calendariolaboral28_id>0){
                            $res28 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,28,$v->calendariolaboral28_id);
                            if(is_object($res28)&&$res28->count()>0){
                                foreach($res28 as $r28){
                                    $d28 = $r28->f_excepciones_en_dia;
                                }

                            }
                        }
                        if($v->calendariolaboral29_id>0){
                            $res29 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,29,$v->calendariolaboral29_id);
                            if(is_object($res29)&&$res29->count()>0){
                                foreach($res29 as $r29){
                                    $d29 = $r29->f_excepciones_en_dia;
                                }

                            }
                        }
                        if($v->calendariolaboral30_id>0){
                            $res30 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,30,$v->calendariolaboral30_id);
                            if(is_object($res30)&&$res30->count()>0){
                                foreach($res30 as $r30){
                                    $d30 = $r30->f_excepciones_en_dia;
                                }

                            }
                        }
                        if($v->calendariolaboral31_id>0){
                            $res31 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,31,$v->calendariolaboral31_id);
                            if(is_object($res31)&&$res31->count()>0){
                                foreach($res31 as $r31){
                                    $d31 = $r31->f_excepciones_en_dia;
                                }

                            }
                        }
                        $horariosymarcaciones[] = array(
                            'nro_row' => 0,
                            #region Columnas de procedimiento f_relaborales()
                            'id_relaboral' => $v->id_relaboral,
                            'id_persona' => $v->id_persona,
                            'p_nombre' => $v->p_nombre,
                            's_nombre' => $v->s_nombre,
                            't_nombre' => $v->t_nombre,
                            'p_apellido' => $v->p_apellido,
                            's_apellido' => $v->s_apellido,
                            'c_apellido' => $v->c_apellido,
                            'nombres' => $v->nombres,
                            'ci' => $v->ci,
                            'expd' => $v->expd,
                            'cargo' => $v->cargo,
                            'sueldo' => str_replace(".00", "", $v->sueldo),
                            'condicion' => $v->condicion,
                            'gerencia_administrativa' => $v->gerencia_administrativa,
                            'departamento_administrativo' => $v->departamento_administrativo,
                            'area' => $v->area,
                            'ubicacion' => $v->ubicacion,
                            #endregion Columnas de procedimiento f_relaborales()

                            'id'=>$v->id_horarioymarcacion,
                            'relaboral_id'=>$v->relaboral_id,
                            'gestion'=>$v->gestion,
                            'mes'=>$v->mes,
                            'mes_nombre'=>$v->mes_nombre,
                            'turno'=>$v->turno,
                            'grupo'=>$v->grupo,
                            'clasemarcacion'=>"e",
                            'clasemarcacion_descripcion'=>"EXCEPCIONES",
                            'modalidadmarcacion_id'=>$v->modalidadmarcacion_id,
                            'modalidad_marcacion'=>"EXCEPCIONES",
                            'd1'=>$d1,
                            'calendariolaboral1_id'=>$v->calendariolaboral1_id,
                            'd2'=>$d2,
                            'calendariolaboral2_id'=>$v->calendariolaboral2_id,
                            'd3'=>$d3,
                            'calendariolaboral3_id'=>$v->calendariolaboral3_id,
                            'd4'=>$d4,
                            'calendariolaboral4_id'=>$v->calendariolaboral4_id,
                            'd5'=>$d5,
                            'calendariolaboral5_id'=>$v->calendariolaboral5_id,
                            'd6'=>$d6,
                            'calendariolaboral6_id'=>$v->calendariolaboral6_id,
                            'd7'=>$d7,
                            'calendariolaboral7_id'=>$v->calendariolaboral7_id,
                            'd8'=>$d8,
                            'calendariolaboral8_id'=>$v->calendariolaboral8_id,
                            'd9'=>$d9,
                            'calendariolaboral9_id'=>$v->calendariolaboral9_id,
                            'd10'=>$d10,
                            'calendariolaboral10_id'=>$v->calendariolaboral10_id,
                            'd11'=>$d11,
                            'calendariolaboral11_id'=>$v->calendariolaboral11_id,
                            'd12'=>$d12,
                            'calendariolaboral12_id'=>$v->calendariolaboral12_id,
                            'd13'=>$d13,
                            'calendariolaboral13_id'=>$v->calendariolaboral13_id,
                            'd14'=>$d14,
                            'calendariolaboral14_id'=>$v->calendariolaboral14_id,
                            'd15'=>$d15,
                            'calendariolaboral15_id'=>$v->calendariolaboral15_id,
                            'd16'=>$d16,
                            'calendariolaboral16_id'=>$v->calendariolaboral16_id,
                            'd17'=>$d17,
                            'calendariolaboral17_id'=>$v->calendariolaboral17_id,
                            'd18'=>$d18,
                            'calendariolaboral18_id'=>$v->calendariolaboral18_id,
                            'd19'=>$d19,
                            'calendariolaboral19_id'=>$v->calendariolaboral19_id,
                            'd20'=>$d20,
                            'calendariolaboral20_id'=>$v->calendariolaboral20_id,
                            'd21'=>$d21,
                            'calendariolaboral21_id'=>$v->calendariolaboral21_id,
                            'd22'=>$d22,
                            'calendariolaboral22_id'=>$v->calendariolaboral22_id,
                            'd23'=>$d23,
                            'calendariolaboral23_id'=>$v->calendariolaboral23_id,
                            'd24'=>$d24,
                            'calendariolaboral24_id'=>$v->calendariolaboral24_id,
                            'd25'=>$d25,
                            'calendariolaboral25_id'=>$v->calendariolaboral25_id,
                            'd26'=>$d26,
                            'calendariolaboral26_id'=>$v->calendariolaboral26_id,
                            'd27'=>$d27,
                            'calendariolaboral27_id'=>$v->calendariolaboral27_id,
                            'd28'=>$d28,
                            'calendariolaboral28_id'=>$v->calendariolaboral28_id,
                            'd29'=>$d29,
                            'calendariolaboral29_id'=>$v->calendariolaboral29_id,
                            'd30'=>$d30,
                            'calendariolaboral30_id'=>$v->calendariolaboral30_id,
                            'd31'=>$d31,
                            'calendariolaboral31_id'=>$v->calendariolaboral31_id,
                            'ultimo_dia'=>$v->ultimo_dia,
                            'atrasos'=>null,
                            'faltas'=>null,
                            'abandono'=>null,
                            'omision'=>null,
                            'lsgh'=>null,
                            'compensacion'=>null,
                            'observacion'=>$v->observacion,
                            'estado'=>$v->estado,
                            'estado_descripcion'=>$v->estado_descripcion,
                            'baja_logica'=>$v->baja_logica,
                            'agrupador'=>$v->agrupador,
                            'user_reg_id'=>$v->user_reg_id,
                            'fecha_reg'=>$v->fecha_reg,
                            'user_apr_id'=>$v->user_apr_id,
                            'fecha_apr'=>$v->fecha_apr,
                            'user_mod_id'=>$v->user_mod_id,
                            'fecha_mod'=>$v->fecha_mod,
                        );
                    }
                    #endregion sector para adicionar una fila para Excepciones
                }
            }
        }
        echo json_encode($horariosymarcaciones);
    }
    /**
     * Función para la obtención del listado de controles de excepción para un registro de relación laboral considerando un rango de fechas.
     * El resultado repite registro de acuerdo a cada fecha dentro del rango de fechas.
     */
    public function listporrelaboralyrangoAction()
    {
        $this->view->disable();
        $controlexcepciones = Array();
        if(isset($_POST["id_relaboral"])&&$_POST["id_relaboral"]>0&&isset($_POST["fecha_ini"])&&isset($_POST["fecha_fin"])){
            $obj = new Fcontrolexcepciones();
            $idRelaboral = $_POST["id_relaboral"];
            $fechaIni = $_POST["fecha_ini"];
            $fechaFin = $_POST["fecha_fin"];
            $resul = $obj->getAllByRelaboralAndRange($idRelaboral,$fechaIni,$fechaFin);
            //comprobamos si hay filas
            if ($resul->count() > 0) {
                foreach ($resul as $v) {
                    $controlexcepciones[] = array(
                        'nro_row' => 0,
                        'id'=>$v->id_controlexcepcion,
                        'id_relaboral'=>$v->id_relaboral,
                        'fecha_ini'=>$v->fecha_ini,
                        'hora_ini'=>$v->hora_ini,
                        'fecha_fin'=>$v->fecha_fin,
                        'hora_fin'=>$v->hora_fin,
                        'justificacion'=>$v->justificacion,
                        'controlexcepcion_observacion'=>$v->controlexcepcion_observacion,
                        'controlexcepcion_estado'=>$v->controlexcepcion_estado,
                        'controlexcepcion_estado_descripcion'=>$v->controlexcepcion_estado_descripcion,
                        'excepcion_id'=>$v->excepcion_id,
                        'excepcion'=>$v->excepcion,
                        'tipoexcepcion_id'=>$v->tipoexcepcion_id,
                        'tipo_excepcion'=>$v->tipo_excepcion,
                        'codigo'=>$v->codigo,
                        'color'=>$v->color,
                        'compensatoria'=>$v->compensatoria,
                        'compensatoria_descripcion'=>$v->compensatoria_descripcion,
                        'genero_id'=>$v->genero_id,
                        'genero'=>$v->genero,
                        'cantidad'=>$v->cantidad,
                        'unidad'=>$v->unidad,
                        'fraccionamiento'=>$v->fraccionamiento,
                        'frecuencia_descripcion'=>$v->frecuencia_descripcion,
                        'redondeo'=>$v->redondeo,
                        'redondeo_descripcion'=>$v->redondeo_descripcion,
                        'observacion'=>$v->observacion,
                        'estado'=>$v->estado,
                        'estado_descripcion'=>$v->estado_descripcion,
                        'baja_logica'=>$v->baja_logica,
                        'agrupador'=>$v->agrupador,
                        'user_reg_id'=>$v->user_reg_id,
                        'fecha_reg'=>$v->fecha_reg,
                        'user_mod_id'=>$v->user_mod_id,
                        'fecha_mod'=>$v->fecha_mod,
                        'fecha' => $v->fecha != "" ? date("Y-m-d", strtotime($v->fecha)) : "",
                        'dia'=>$v->dia,
                        'dia_nombre'=>$v->dia_nombre,
                        'dia_nombre_abr_ing'=>$v->dia_nombre_abr_ing
                    );
                }
            }
        }
        echo json_encode($controlexcepciones);
    }
    /**
     * Función para el almacenamiento y actualización de un registro de Control de Excepción.
     * return array(EstadoResultado,Mensaje)
     * Los valores posibles para la variable EstadoResultado son:
     *  0: Error
     *   1: Procesado
     *  -1: Crítico Error
     *  -2: Error de Conexión
     *  -3: Usuario no Autorizado
     */
    public function saveAction()
    {
        $auth = $this->session->get('auth');
        $user_reg_id = $user_mod_id = $auth['id'];
        $msj = Array();
        $hoy = date("Y-m-d H:i:s");
        $this->view->disable();
        if (isset($_POST["id"]) && $_POST["id"] > 0) {
            /**
             * Modificación de registro de Feriado
             */
            $idRelaboral = $_POST['relaboral_id'];
            $idExcepcion = $_POST['excepcion_id'];
            $fechaIni = $_POST['fecha_ini'];
            $horaIni = $_POST['hora_ini'];
            $fechaFin = $_POST['fecha_fin'];
            $horaFin = $_POST['hora_fin'];
            $justificacion = $_POST['justificacion'];
            $observacion = $_POST['observacion'];
            if($idRelaboral>0&&$idExcepcion>0&&$fechaIni!=''&&$horaIni!=''&&$fechaFin!=''&&$horaFin!=''&&$justificacion!=''){
                $objControlExcepciones = Controlexcepciones::findFirst(array("id=".$_POST["id"]));
                if(count($objControlExcepciones)>0){
                    $cantMismosDatos = Controlexcepciones::count(array("id!=".$_POST["id"]." AND relaboral_id=".$idRelaboral." AND excepcion_id = ".$idExcepcion." AND fecha_ini='".$fechaIni."' AND hora_ini='".$horaIni."' AND fecha_fin = '".$fechaFin."' AND hora_fin='".$horaFin."' AND baja_logica=1 AND estado>=0"));
                    if($cantMismosDatos==0){
                        $objControlExcepciones->relaboral_id = $idRelaboral;
                        $objControlExcepciones->excepcion_id = $idExcepcion;
                        $objControlExcepciones->fecha_ini = $fechaIni;
                        $objControlExcepciones->fecha_fin = $fechaFin;
                        $objControlExcepciones->hora_ini = $horaIni;
                        $objControlExcepciones->hora_fin = $horaFin;
                        $objControlExcepciones->justificacion=$justificacion;
                        $objControlExcepciones->observacion=$observacion;
                        $objControlExcepciones->user_mod_id=$user_mod_id;
                        $objControlExcepciones->fecha_mod=$hoy;
                        try{
                            $ok = $objControlExcepciones->save();
                            if ($ok)  {
                                $msj = array('result' => 1, 'msj' => '&Eacute;xito: Se modific&oacute; correctamente el registro del control de excepci&oacute;n.');
                            } else {
                                $msj = array('result' => 0, 'msj' => 'Error: No se modific&oacute; el registro del control de excepci&oacute;n.');
                            }
                        }catch (\Exception $e) {
                            echo get_class($e), ": ", $e->getMessage(), "\n";
                            echo " File=", $e->getFile(), "\n";
                            echo " Line=", $e->getLine(), "\n";
                            echo $e->getTraceAsString();
                            $msj = array('result' => -1, 'msj' => 'Error cr&iacute;tico: No se guard&oacute; el registro del control de excepci&oacute;n.');
                        }
                    }else $msj = array('result' => 0, 'msj' => 'Error: Los datos enviados son similares a otro registro existente, debe modificar los valores necesariamente.');
                }
            }else{
                $msj = array('result' => 0, 'msj' => 'Error: Los datos enviados no cumplen los criterios necesarios para su registro.');
            }
        }else{
            /**
             * Registro de Control de Excepción
             */
            $idRelaboral = $_POST['relaboral_id'];
            $idExcepcion = $_POST['excepcion_id'];
            $fechaIni = $_POST['fecha_ini'];
            $horaIni = $_POST['hora_ini'];
            $fechaFin = $_POST['fecha_fin'];
            $horaFin = $_POST['hora_fin'];
            $justificacion = $_POST['justificacion'];
            $observacion = $_POST['observacion'];
            if($idRelaboral>0&&$idExcepcion>0&&$fechaIni!=''&&$horaIni!=''&&$fechaFin!=''&&$horaFin!=''&&$justificacion!=''){
                $cantMismosDatos = Controlexcepciones::count(array("relaboral_id=".$idRelaboral." AND excepcion_id = ".$idExcepcion." AND fecha_ini='".$fechaIni."' AND hora_ini='".$horaIni."' AND fecha_fin = '".$fechaFin."' AND hora_fin='".$horaFin."' AND baja_logica=1 AND estado>=0"));
                if($cantMismosDatos==0){
                    $objControlExcepciones = new Controlexcepciones();
                    $objControlExcepciones->relaboral_id = $idRelaboral;
                    $objControlExcepciones->excepcion_id = $idExcepcion;
                    $objControlExcepciones->fecha_ini = $fechaIni;
                    $objControlExcepciones->fecha_fin = $fechaFin;
                    $objControlExcepciones->hora_ini = $horaIni;
                    $objControlExcepciones->hora_fin = $horaFin;
                    $objControlExcepciones->justificacion=$justificacion;
                    $objControlExcepciones->observacion=$observacion;
                    $objControlExcepciones->estado=2;
                    $objControlExcepciones->baja_logica=1;
                    $objControlExcepciones->agrupador=0;
                    $objControlExcepciones->user_reg_id=$user_reg_id;
                    $objControlExcepciones->fecha_reg=$hoy;
                    try{
                        $ok = $objControlExcepciones->save();
                        if ($ok)  {
                            $msj = array('result' => 1, 'msj' => '&Eacute;xito: Se guard&oacute; correctamente.');
                        } else {
                            $msj = array('result' => 0, 'msj' => 'Error: No se registr&oacute;.');
                        }
                    }catch (\Exception $e) {
                        echo get_class($e), ": ", $e->getMessage(), "\n";
                        echo " File=", $e->getFile(), "\n";
                        echo " Line=", $e->getLine(), "\n";
                        echo $e->getTraceAsString();
                        $msj = array('result' => -1, 'msj' => 'Error cr&iacute;tico: No se guard&oacute; el registro del control de excepci&oacute;n.');
                    }
                }    else{
                    $msj = array('result' => 0, 'msj' => 'Error: Existe registro de control de excepci&oacute;n con datos similares.');
                }
            }else{
                $msj = array('result' => 0, 'msj' => 'Error: Los datos enviados no cumplen los criterios necesarios para su registro.');
            }
        }
        echo json_encode($msj);
    }
    /*
     * Función para la aprobación del registro de un control de excepción.
     */
    public function approveAction()
    {
        $auth = $this->session->get('auth');
        $user_mod_id = $auth['id'];
        $msj = Array();
        $hoy = date("Y-m-d H:i:s");
        $this->view->disable();
        if (isset($_POST["id"]) && $_POST["id"] > 0) {
            /**
             * Aprobación de registro
             */
            $objControlExcepciones = Controlexcepciones::findFirstById($_POST["id"]);
            if ($objControlExcepciones->id > 0 && $objControlExcepciones->estado == 2) {
                try {
                    $objControlExcepciones->estado = 3;
                    $objControlExcepciones->user_mod_id = $user_mod_id;
                    $objControlExcepciones->fecha_mod = $hoy;
                    $ok = $objControlExcepciones->save();
                    if ($ok) {
                        $msj = array('result' => 1, 'msj' => '&Eacute;xito: Se aprob&oacute; correctamente el registro del control de  excepci&oacute;n.');
                    } else {
                        $msj = array('result' => 0, 'msj' => 'Error: No se aprob&oacute; el registro de control de excepci&oacute;n.');
                    }
                } catch (\Exception $e) {
                    echo get_class($e), ": ", $e->getMessage(), "\n";
                    echo " File=", $e->getFile(), "\n";
                    echo " Line=", $e->getLine(), "\n";
                    echo $e->getTraceAsString();
                    $msj = array('result' => -1, 'msj' => 'Error cr&iacute;tico: No se guard&oacute; el registro del control de excepci&oacute;n.');
                }
            } else {
                $msj = array('result' => 0, 'msj' => 'Error: El registro de control de excepci&oacute;n no cumple con el requisito establecido para su aprobaci&oacute;n, debe estar en estado EN PROCESO.');
            }
        } else {
            $msj = array('result' => -1, 'msj' => 'Error cr&iacute;tico: No se envi&oacute; el identificador del registro del control de excepci&oacute;n.');
        }
        echo json_encode($msj);
    }
    /**
     * Función para el la baja del registro de un control de excepción.
     * return array(EstadoResultado,Mensaje)
     * Los valores posibles para la variable EstadoResultado son:
     *  0: Error
     *   1: Procesado
     *  -1: Crítico Error
     *  -2: Error de Conexión
     *  -3: Usuario no Autorizado
     */
    public function downAction()
    {
        $auth = $this->session->get('auth');
        $user_mod_id = $auth['id'];
        $msj = Array();
        $hoy = date("Y-m-d H:i:s");
        $this->view->disable();
        try {
            if (isset($_POST["id"]) && $_POST["id"] > 0) {
                /**
                 * Baja de registro
                 */
                $objControlExcepciones = Controlexcepciones::findFirstById($_POST["id"]);
                $objControlExcepciones->estado = 0;
                $objControlExcepciones->baja_logica = 1;
                $objControlExcepciones->user_mod_id = $user_mod_id;
                $objControlExcepciones->fecha_mod = $hoy;
                if ($objControlExcepciones->save()) {
                    $msj = array('result' => 1, 'msj' => '&Eacute;xito: Registro de Baja realizado de modo satisfactorio.');
                } else {
                    foreach ($objControlExcepciones->getMessages() as $message) {
                        echo $message, "\n";
                    }
                    $msj = array('result' => -1, 'msj' => 'Error cr&iacute;tico: No se pudo dar de baja al registro de la excepci&oacute;n.');
                }
            } else $msj = array('result' => -1, 'msj' => 'Error cr&iacute;tico: No se efectu&oacute; la baja debido a que no se especific&oacute; el registro de la excepci&oacute;n.');
        } catch (\Exception $e) {
            echo get_class($e), ": ", $e->getMessage(), "\n";
            echo " File=", $e->getFile(), "\n";
            echo " Line=", $e->getLine(), "\n";
            echo $e->getTraceAsString();
            $msj = array('result' => -1, 'msj' => 'Error cr&iacute;tico: No se guard&oacute; el registro del control de excepci&oacute;n.');
        }
        echo json_encode($msj);
    }
    /**
     * Función para la verificación
     */
    public function verificacruceAction(){
        $auth = $this->session->get('auth');
        $user_mod_id = $auth['id'];
        $msj = Array();
        $hoy = date("Y-m-d H:i:s");
        $this->view->disable();
        $id = $_POST['id'];
        $idRelaboral = $_POST['relaboral_id'];
        $idExcepcion = $_POST['excepcion_id'];
        $fechaIni = $_POST['fecha_ini'];
        $horaIni = $_POST['hora_ini'];
        $fechaFin = $_POST['fecha_fin'];
        $horaFin = $_POST['hora_fin'];
        $justificacion = $_POST['justificacion'];
        if($idRelaboral>0&&$idExcepcion>0&&$fechaIni!=''&&$horaIni!=''&&$fechaFin!=''&&$horaFin!=''&&$justificacion!=''){
            /**
             * Se realiza la verificación sobre el cruce de horarios y fechas de los controles de excepción existentes y la que se intenta registrar o modificar.
             */
            /*$objControlExcepciones = Controlexcepciones::findFirstById($_POST["id"]);
            if ($objControlExcepciones->id > 0 && $objControlExcepciones->estado == 2) {
                try {
                    $objControlExcepciones->estado = 1;
                    $objControlExcepciones->user_mod_id = $user_mod_id;
                    $objControlExcepciones->fecha_mod = $hoy;
                    $ok = $objControlExcepciones->save();
                    if ($ok) {
                        $msj = array('result' => 1, 'msj' => '&Eacute;xito: Se aprob&oacute; correctamente el registro del control de  excepci&oacute;n.');
                    } else {
                        $msj = array('result' => 0, 'msj' => 'Error: No se aprob&oacute; el registro de control de excepci&oacute;n.');
                    }
                } catch (\Exception $e) {
                    echo get_class($e), ": ", $e->getMessage(), "\n";
                    echo " File=", $e->getFile(), "\n";
                    echo " Line=", $e->getLine(), "\n";
                    echo $e->getTraceAsString();
                    $msj = array('result' => -1, 'msj' => 'Error cr&iacute;tico: No se guard&oacute; el registro del control de excepci&oacute;n.');
                }
            } else {
                $msj = array('result' => 0, 'msj' => 'Error: El registro de control de excepci&oacute;n no cumple con el requisito establecido para su aprobaci&oacute;n, debe estar en estado EN PROCESO.');
            }*/
            $msj = array('result' => 0, 'msj' => 'No existe cruce de horarios ni fechas.');
        } else {
            $msj = array('result' => -1, 'msj' => 'Error cr&iacute;tico: No se envi&oacute; el identificador del registro del control de excepci&oacute;n.');
        }
        echo json_encode($msj);
    }
    /**
     * Función para la exportación del reporte en formato Excel.
     * @param $n_rows Cantidad de lineas
     * @param $columns Array con las columnas mostradas en el reporte
     * @param $filtros Array con los filtros aplicados sobre las columnas.
     * @param $groups String con la cadena representativa de las columnas agrupadas. La separación es por comas.
     * @param $sorteds  Columnas ordenadas .
     */
    public function exportmarcacionesexcelAction($idRelaboral,$n_rows, $columns, $filtros,$groups,$sorteds)
    {   $columns = base64_decode(str_pad(strtr($columns, '-_', '+/'), strlen($columns) % 4, '=', STR_PAD_RIGHT));
        $filtros = base64_decode(str_pad(strtr($filtros, '-_', '+/'), strlen($columns) % 4, '=', STR_PAD_RIGHT));
        $groups = base64_decode(str_pad(strtr($groups, '-_', '+/'), strlen($groups) % 4, '=', STR_PAD_RIGHT));
        if($groups=='null'||$groups==null)$groups="";
        $sorteds = base64_decode(str_pad(strtr($sorteds, '-_', '+/'), strlen($sorteds) % 4, '=', STR_PAD_RIGHT));
        $columns = json_decode($columns, true);
        $filtros = json_decode($filtros, true);
        $sub_keys = array_keys($columns);//echo $sub_keys[0];
        $n_col = count($columns);//echo$keys[1];
        $sorteds = json_decode($sorteds, true);
        /**
         * Especificando la configuración de las columnas
         */
        $generalConfigForAllColumns = array(
            'nro_row' => array('title' => 'Nro.', 'width' => 8, 'title-align'=>'C','align' => 'C', 'type' => 'int4'),
            'estado_descripcion' => array('title' => 'Estado', 'width' => 15, 'align' => 'C', 'type' => 'varchar'),
            'gestion' => array('title' => 'Gestion', 'width' => 20, 'align' => 'C', 'type' => 'numeric'),
            'mes_nombre' => array('title' => 'Mes', 'width' => 20, 'align' => 'C', 'type' => 'varchar'),
            'turno' => array('title' => 'Turno', 'width' => 10, 'align' => 'C', 'type' => 'numeric'),
            'modalidad_marcacion' => array('title' => 'Modalidad', 'width' => 30, 'align' => 'C', 'type' => 'varchar'),
            'd1' => array('title' => 'Dia 1', 'width' => 18, 'align' => 'C', 'type' => 'string'),
            /*'estado1_descripcion' => array('title' => 'Estado Dia 1', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd2' => array('title' => 'Dia 2', 'width' => 18, 'align' => 'C', 'type' => 'string'),
            /*'estado2_descripcion' => array('title' => 'Estado Dia 2', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd3' => array('title' => 'Dia 3', 'width' => 18, 'align' => 'C', 'type' => 'string'),
            /*'estado3_descripcion' => array('title' => 'Estado Dia 3', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd4' => array('title' => 'Dia 4', 'width' => 18, 'align' => 'C', 'type' => 'string'),
            /*'estado4_descripcion' => array('title' => 'Estado Dia 4', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd5' => array('title' => 'Dia 5', 'width' => 18, 'align' => 'C', 'type' => 'string'),
            /*'estado5_descripcion' => array('title' => 'Estado Dia 5', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd6' => array('title' => 'Dia 6', 'width' => 18, 'align' => 'C', 'type' => 'string'),
            /*'estado6_descripcion' => array('title' => 'Estado Dia 6', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd7' => array('title' => 'Dia 7', 'width' => 18, 'align' => 'C', 'type' => 'string'),
            /*'estado7_descripcion' => array('title' => 'Estado Dia 7', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd8' => array('title' => 'Dia 8', 'width' => 18, 'align' => 'C', 'type' => 'string'),
            /*'estado8_descripcion' => array('title' => 'Estado Dia 8', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd9' => array('title' => 'Dia 9', 'width' => 18, 'align' => 'C', 'type' => 'string'),
            /*'estado9_descripcion' => array('title' => 'Estado Dia 9', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd10' => array('title' => 'Dia 10', 'width' => 18, 'align' => 'C', 'type' => 'string'),
            /*'estado10_descripcion' => array('title' => 'Estado Dia 10', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd11' => array('title' => 'Dia 11', 'width' => 18, 'align' => 'C', 'type' => 'string'),
            /*'estado11_descripcion' => array('title' => 'Estado Dia 11', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd12' => array('title' => 'Dia 12', 'width' => 18, 'align' => 'C', 'type' => 'string'),
            /*'estado12_descripcion' => array('title' => 'Estado Dia 12', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd13' => array('title' => 'Dia 13', 'width' => 18, 'align' => 'C', 'type' => 'string'),
            /*'estado13_descripcion' => array('title' => 'Estado Dia 13', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd14' => array('title' => 'Dia 14', 'width' => 18, 'align' => 'C', 'type' => 'string'),
            /*'estado14_descripcion' => array('title' => 'Estado Dia 14', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd15' => array('title' => 'Dia 15', 'width' => 18, 'align' => 'C', 'type' => 'string'),
            /*'estado15_descripcion' => array('title' => 'Estado Dia 15', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd16' => array('title' => 'Dia 16', 'width' => 18, 'align' => 'C', 'type' => 'string'),
            /*'estado16_descripcion' => array('title' => 'Estado Dia 16', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd17' => array('title' => 'Dia 17', 'width' => 18, 'align' => 'C', 'type' => 'string'),
            /*'estado17_descripcion' => array('title' => 'Estado Dia 17', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd18' => array('title' => 'Dia 18', 'width' => 18, 'align' => 'C', 'type' => 'string'),
            /*'estado18_descripcion' => array('title' => 'Estado Dia 18', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd19' => array('title' => 'Dia 19', 'width' => 18, 'align' => 'C', 'type' => 'string'),
            /*'estado19_descripcion' => array('title' => 'Estado Dia 19', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd20' => array('title' => 'Dia 20', 'width' => 18, 'align' => 'C', 'type' => 'string'),
            /*'estado20_descripcion' => array('title' => 'Estado Dia 20', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd21' => array('title' => 'Dia 21', 'width' => 18, 'align' => 'C', 'type' => 'string'),
            /*'estado21_descripcion' => array('title' => 'Estado Dia 21', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd22' => array('title' => 'Dia 22', 'width' => 18, 'align' => 'C', 'type' => 'string'),
            /*'estado22_descripcion' => array('title' => 'Estado Dia 22', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd23' => array('title' => 'Dia 23', 'width' => 18, 'align' => 'C', 'type' => 'string'),
            /*'estado23_descripcion' => array('title' => 'Estado Dia 23', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd24' => array('title' => 'Dia 24', 'width' => 18, 'align' => 'C', 'type' => 'string'),
            /*'estado24_descripcion' => array('title' => 'Estado Dia 24', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd25' => array('title' => 'Dia 25', 'width' => 18, 'align' => 'C', 'type' => 'string'),
            /*'estado25_descripcion' => array('title' => 'Estado Dia 25', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd26' => array('title' => 'Dia 26', 'width' => 18, 'align' => 'C', 'type' => 'string'),
            /*'estado26_descripcion' => array('title' => 'Estado Dia 26', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd27' => array('title' => 'Dia 27', 'width' => 18, 'align' => 'C', 'type' => 'string'),
            /*'estado27_descripcion' => array('title' => 'Estado Dia 27', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd28' => array('title' => 'Dia 28', 'width' => 18, 'align' => 'C', 'type' => 'string'),
            /*'estado28_descripcion' => array('title' => 'Estado Dia 28', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd29' => array('title' => 'Dia 29', 'width' => 18, 'align' => 'C', 'type' => 'string'),
            /*'estado29_descripcion' => array('title' => 'Estado Dia 29', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd30' => array('title' => 'Dia 30', 'width' => 18, 'align' => 'C', 'type' => 'string'),
            /*'estado30_descripcion' => array('title' => 'Estado Dia 30', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd31' => array('title' => 'Dia 31', 'width' => 18, 'align' => 'C', 'type' => 'string'),
            /*'estado31_descripcion' => array('title' => 'Estado Dia 31', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'ultimo_dia' => array('title' => 'Ultimo Dia Procesado', 'width' => 10, 'align' => 'C', 'type' => 'numeric'),
            'atrasos' => array('title' => 'Atrasos', 'width' => 20, 'align' => 'C', 'type' => 'numeric'),
            'faltas' => array('title' => 'Faltas', 'width' => 20, 'align' => 'C', 'type' => 'numeric'),
            'abandono' => array('title' => 'Abandono', 'width' => 20, 'align' => 'C', 'type' => 'numeric'),
            'omision' => array('title' => 'Omision', 'width' => 20, 'align' => 'C', 'type' => 'numeric'),
            'lsgh' => array('title' => 'LSGH', 'width' => 20, 'align' => 'C', 'type' => 'numeric'),
            'observacion' => array('title' => 'Observacion', 'width' => 15, 'align' => 'L', 'type' => 'varchar')
        );
        $agruparPor = ($groups!="")?explode(",",$groups):array();
        $widthsSelecteds = $this->DefineWidths($generalConfigForAllColumns, $columns,$agruparPor);
        $ancho = 0;
        if($idRelaboral>0&&count($widthsSelecteds)>0) {
            foreach ($widthsSelecteds as $w) {
                $ancho = $ancho + $w;
            }
            $excel = new exceloasis();
            $excel->tableWidth = $ancho;
            #region Proceso de generación del documento Excel
            $excel->debug = 0;
            $excel->title_rpt = utf8_decode('Reporte Marcaciones');
            $excel->header_title_empresa_rpt = utf8_decode('Empresa Estatal de Transporte por Cable "Mi Teleférico"');
            $alignSelecteds = $excel->DefineAligns($generalConfigForAllColumns, $columns, $agruparPor);
            $colSelecteds = $excel->DefineCols($generalConfigForAllColumns, $columns, $agruparPor);
            $colTitleSelecteds = $excel->DefineTitleCols($generalConfigForAllColumns, $columns, $agruparPor);
            $alignTitleSelecteds = $excel->DefineTitleAligns(count($colTitleSelecteds));
            $formatTypes = $excel->DefineTypeCols($generalConfigForAllColumns, $columns, $agruparPor);
            $gruposSeleccionadosActuales = $excel->DefineDefaultValuesForGroups($groups);
            $excel->generalConfigForAllColumns = $generalConfigForAllColumns;
            $excel->colTitleSelecteds = $colTitleSelecteds;
            $excel->widthsSelecteds = $widthsSelecteds;
            $excel->alignSelecteds = $alignSelecteds;
            $excel->alignTitleSelecteds = $alignTitleSelecteds;

            $cantCol = count($colTitleSelecteds);
            $excel->ultimaLetraCabeceraTabla = $excel->columnasExcel[$cantCol-1];
            $excel->penultimaLetraCabeceraTabla = $excel->columnasExcel[$cantCol-2];
            $excel->numFilaCabeceraTabla = 4;
            $excel->primeraLetraCabeceraTabla = "A";
            $excel->segundaLetraCabeceraTabla = "B";
            $excel->celdaInicial = $excel->primeraLetraCabeceraTabla.$excel->numFilaCabeceraTabla;
            $excel->celdaFinal = $excel->ultimaLetraCabeceraTabla.$excel->numFilaCabeceraTabla;
            if($cantCol<=9){
                $excel->defineOrientation("V");
                $excel->defineSize("C");
            }elseif($cantCol<=13){
                $excel->defineOrientation("H");
                $excel->defineSize("C");
            }else{
                $excel->defineOrientation("H");
                $excel->defineSize("O");
            }
            if ($excel->debug == 1) {
                echo "<p>^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^idRelaboral^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^";
                echo "<p>".$idRelaboral;
                echo "<p>^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^";
                echo "<p>::::::::::::::::::::::::::::::::::::::::::::COLUMNAS::::::::::::::::::::::::::::::::::::::::::<p>";
                print_r($columns);
                echo "<p>::::::::::::::::::::::::::::::::::::::::::::FILTROS::::::::::::::::::::::::::::::::::::::::::<p>";
                print_r($filtros);
                echo "<p>::::::::::::::::::::::::::::::::::::::::::::GRUPOS::::::::::::::::::::::::::::::::::::::::::::<p>";
                echo "<p>" . $groups;
                echo "<p>::::::::::::::::::::::::::::::::::::::::::::ORDEN::::::::::::::::::::::::::::::::::::::::::::<p>";
                print_r($sorteds);
                echo "<p>:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::<p>";
            }
            $where = '';
            $yaConsiderados = array();
            for ($k = 0; $k < count($filtros); $k++) {
                $cant = $this->obtieneCantidadVecesConsideracionPorColumnaEnFiltros($filtros[$k]['columna'], $filtros);
                $arr_val = $this->obtieneValoresConsideradosPorColumnaEnFiltros($filtros[$k]['columna'], $filtros);

                for ($j = 0; $j < $n_col; $j++) {
                    if ($sub_keys[$j] == $filtros[$k]['columna']) {
                        $col_fil = $columns[$sub_keys[$j]]['text'];
                    }
                }
                if ($filtros[$k]['tipo'] == 'datefilter') {
                    $filtros[$k]['valor'] = date("Y-m-d", strtotime($filtros[$k]['valor']));
                }
                $cond_fil = ' ' . $col_fil;
                if (!in_array($filtros[$k]['columna'], $yaConsiderados)) {

                    if (strlen($where) > 0) {
                        switch ($filtros[$k]['condicion']) {
                            case 'EMPTY':
                                $where .= ' AND ';
                                break;
                            case 'NOT_EMPTY':
                                $where .= ' AND ';
                                break;
                            case 'CONTAINS':
                                $where .= ' AND ';
                                break;
                            case 'EQUAL':
                                $where .= ' AND ';
                                break;
                            case 'GREATER_THAN_OR_EQUAL':
                                $where .= ' AND ';
                                break;
                            case 'LESS_THAN_OR_EQUAL':
                                $where .= ' AND ';
                                break;
                        }
                    }
                }
                if ($cant > 1) {
                    if ($excel->debug == 1) {
                        echo "<p>::::::::::::::::::::::::::::::::::::YA CONSIDERADOS:::::::::::::::::::::::::::::::::::::::::::::::<p>";
                        print_r($yaConsiderados);
                        echo "<p>::::::::::::::::::::::::::::::::::::YA CONSIDERADOS:::::::::::::::::::::::::::::::::::::::::::::::<p>";
                    }
                    if (!in_array($filtros[$k]['columna'], $yaConsiderados)) {
                        switch ($filtros[$k]['condicion']) {
                            case 'EMPTY':
                                $cond_fil .= utf8_encode(" que sea vacía ");
                                $where .= "(" . $filtros[$k]['columna'] . " IS NULL OR " . $filtros[$k]['columna'] . " ILIKE '')";
                                break;
                            case 'NOT_EMPTY':
                                $cond_fil .= utf8_encode(" que no sea vacía ");
                                $where .= "(" . $filtros[$k]['columna'] . " IS NOT NULL OR " . $filtros[$k]['columna'] . " NOT ILIKE '')";
                                break;
                            case 'CONTAINS':
                                $cond_fil .= utf8_encode(" que contenga el valor:  " . $filtros[$k]['valor']);
                                    $where .= $filtros[$k]['columna'] . " ILIKE '%" . $filtros[$k]['valor'] . "%'";
                                break;
                            case 'EQUAL':
                                $cond_fil .= utf8_encode(" que contenga el valor:  " . $filtros[$k]['valor']);
                                $ini = 0;
                                foreach ($arr_val as $col) {
                                    if ($excel->debug == 1) {

                                        echo "<p>.........................recorriendo las columnas multiseleccionadas: .............................................";
                                        echo $filtros[$k]['columna'] . "-->" . $col;
                                        echo "<p>.........................recorriendo las columnas multiseleccionadas: .............................................";
                                    }
                                    if (isset($generalConfigForAllColumns[$filtros[$k]['columna']]['type'])) {
                                        //$where .= $filtros[$k]['columna']." ILIKE '".$filtros[$k]['valor']."'";
                                        if ($ini == 0) {
                                            $where .= " (";
                                        }
                                        switch (@$generalConfigForAllColumns[$filtros[$k]['columna']]['type']) {
                                            case 'int4':
                                            case 'numeric':
                                            case 'date':
                                                //$whereEqueals .= $filtros[$k]['columna']." = '".$filtros[$k]['valor']."'";
                                                $where .= $filtros[$k]['columna'] . " = '" . $col . "'";
                                                break;
                                            case 'varchar':
                                            case 'bpchar':
                                                //$whereEqueals .= $filtros[$k]['columna']." ILIKE '".$filtros[$k]['valor']."'";
                                                $where .= $filtros[$k]['columna'] . " ILIKE '" . $col . "'";
                                                break;
                                        }
                                        $ini++;
                                        if ($ini == count($arr_val)) {
                                            $where .= ") ";
                                        } else $where .= " OR ";
                                    }
                                }
                                break;
                            case 'GREATER_THAN_OR_EQUAL':
                                $cond_fil .= utf8_encode(" que sea mayor o igual que:  " . $filtros[$k]['valor']);
                                $ini = 0;
                                foreach ($arr_val as $col) {
                                    //$fecha = date("Y-m-d", $col);
                                    $fecha = $col;
                                    if (isset($generalConfigForAllColumns[$filtros[$k]['columna']]['type'])) {
                                        //$where .= $filtros[$k]['columna']." ILIKE '".$filtros[$k]['valor']."'";
                                        if ($ini == 0) {
                                            $where .= " (";
                                        }
                                        switch (@$generalConfigForAllColumns[$filtros[$k]['columna']]['type']) {
                                            case 'int4':
                                            case 'numeric':
                                                $where .= $filtros[$k]['columna'] . " = '" . $fecha . "'";
                                                break;
                                            case 'date':
                                                //$whereEqueals .= $filtros[$k]['columna']." = '".$filtros[$k]['valor']."'";
                                                if ($ini == 0) {
                                                    $where .= $filtros[$k]['columna'] . " BETWEEN ";
                                                } else {
                                                    $where .= " AND ";
                                                }
                                                $where .= "'" . $fecha . "'";

                                                break;
                                            case 'varchar':
                                            case 'bpchar':
                                                //$whereEqueals .= $filtros[$k]['columna']." ILIKE '".$filtros[$k]['valor']."'";
                                                $where .= $filtros[$k]['columna'] . " ILIKE '" . $col . "'";
                                                break;
                                        }
                                        $ini++;
                                        if ($ini == count($arr_val)) {
                                            $where .= ") ";
                                        }
                                    }
                                }
                                break;
                            case 'LESS_THAN_OR_EQUAL':
                                $cond_fil .= utf8_encode(" que sea menor o igual que:  " . $filtros[$k]['valor']);
                                $where .= $filtros[$k]['columna'] . ' <= "' . $filtros[$k]['valor'] . '"';
                                break;
                        }
                        $yaConsiderados[] = $filtros[$k]['columna'];
                    }
                } else {
                    switch ($filtros[$k]['condicion']) {
                        case 'EMPTY':
                            $cond_fil .= utf8_encode(" que sea vacía ");
                            $where .= "(" . $filtros[$k]['columna'] . " IS NULL OR " . $filtros[$k]['columna'] . " ILIKE '')";
                            break;
                        case 'NOT_EMPTY':
                            $cond_fil .= utf8_encode(" que no sea vacía ");
                            $where .= "(" . $filtros[$k]['columna'] . " IS NOT NULL OR " . $filtros[$k]['columna'] . " NOT ILIKE '')";
                            break;
                        case 'CONTAINS':
                            $cond_fil .= utf8_encode(" que contenga el valor:  " . $filtros[$k]['valor']);
                            $where .= $filtros[$k]['columna'] . " ILIKE '%" . $filtros[$k]['valor'] . "%'";
                            break;
                        case 'EQUAL':
                            $cond_fil .= utf8_encode(" que contenga el valor:  " . $filtros[$k]['valor']);
                            if (isset($generalConfigForAllColumns[$filtros[$k]['columna']]['type'])) {
                                //$where .= $filtros[$k]['columna']." ILIKE '".$filtros[$k]['valor']."'";
                                switch (@$generalConfigForAllColumns[$filtros[$k]['columna']]['type']) {
                                    case 'int4':
                                    case 'numeric':
                                    case 'date':
                                        //$whereEqueals .= $filtros[$k]['columna']." = '".$filtros[$k]['valor']."'";
                                        $where .= $filtros[$k]['columna'] . " = '" . $filtros[$k]['valor'] . "'";
                                        break;
                                    case 'varchar':
                                    case 'bpchar':
                                        //$whereEqueals .= $filtros[$k]['columna']." ILIKE '".$filtros[$k]['valor']."'";
                                        $where .= $filtros[$k]['columna'] . " ILIKE '" . $filtros[$k]['valor'] . "'";
                                        break;
                                }
                            }
                            break;
                        case 'GREATER_THAN_OR_EQUAL':
                            $cond_fil .= utf8_encode(" que sea mayor o igual que:  " . $filtros[$k]['valor']);
                            $where .= $filtros[$k]['columna'] . ' >= "' . $filtros[$k]['valor'] . '"';
                            break;
                        case 'LESS_THAN_OR_EQUAL':
                            $cond_fil .= utf8_encode(" que sea menor o igual que:  " . $filtros[$k]['valor']);
                            $where .= $filtros[$k]['columna'] . ' <= "' . $filtros[$k]['valor'] . '"';
                            break;
                    }
                }

            }
            $obj = new Fhorariosymarcaciones();
            if ($where != "") $where = " WHERE " . $where;
            $groups_aux = "";
            if ($groups != "") {
                /**
                 * Se verifica que no se considere la columna nombres debido a que contenido ya esta ordenado por las
                 * columnas p_apellido, s_apellido, c_apellido, p_anombre, s_nombre, t_nombre
                 */
                /*if (strrpos($groups, "nombres")) {
                    if (strrpos($groups, ",")) {
                        $arr = explode(",", $groups);
                        foreach ($arr as $val) {
                            if ($val != "nombres")
                                $groups_aux[] = $val;
                        }
                        $groups = implode(",", $groups_aux);
                    } else $groups = "";
                }*/
                if (is_array($sorteds) && count($sorteds) > 0) {
                    if ($groups != "") $groups .= ",";
                    $coma = "";
                    if ($excel->debug == 1) {
                        echo "<p>===========================================Orden======================================</p>";
                        print_r($sorteds);
                        echo "<p>===========================================Orden======================================</p>";
                    }
                    foreach ($sorteds as $ord => $orden) {
                        $groups .= $coma . $ord;
                        if ($orden['asc'] == '') $groups .= " ASC"; else$groups .= " DESC";
                        $coma = ",";
                    }
                }
                if ($groups != "")
                    $groups = " ORDER BY " . $groups . ",relaboral_id,gestion,mes,turno,modalidadmarcacion_id";
                if ($excel->debug == 1) echo "<p>La consulta es: " . $groups . "<p>";
            } else {
                if (is_array($sorteds) && count($sorteds) > 0) {
                    $coma = "";
                    if ($excel->debug == 1) {
                        echo "<p>===========================================Orden======================================</p>";
                        print_r($sorteds);
                        echo "<p>===========================================Orden======================================</p>";
                    }
                    foreach ($sorteds as $ord => $orden) {
                        $groups .= $coma . $ord;
                        if ($orden['asc'] == '') $groups .= " ASC"; else$groups .= " DESC";
                        $coma = ",";
                    }
                    $groups = " ORDER BY " . $groups;
                }

            }
            if ($excel->debug == 1) echo "<p>WHERE------------------------->" . $where . "<p>";
            if ($excel->debug == 1) echo "<p>GROUP BY------------------------->" . $groups . "<p>";
            $resul = $obj->getAll("WHERE relaboral_id=".$idRelaboral,$groups);

            $horariosymarcaciones = array();
            $listaExcepciones = array();
            $contador = 0;
            foreach ($resul as $v) {
                $horariosymarcaciones[] = array(
                    'id'=>$v->id_horarioymarcacion,
                    'relaboral_id'=>$v->relaboral_id,
                    'gestion'=>$v->gestion,
                    'mes'=>$v->mes,
                    'mes_nombre'=>$v->mes_nombre,
                    'turno'=>$v->turno,
                    'grupo'=>$v->grupo,
                    'clasemarcacion'=>$v->clasemarcacion,
                    'clasemarcacion_descripcion'=>$v->clasemarcacion_descripcion,
                    'modalidadmarcacion_id'=>$v->modalidadmarcacion_id,
                    'modalidad_marcacion'=>$v->modalidad_marcacion,
                    'd1'=>$v->d1,
                    'calendariolaboral1_id'=>$v->calendariolaboral1_id,
                    'd2'=>$v->d2,
                    'calendariolaboral2_id'=>$v->calendariolaboral2_id,
                    'd3'=>$v->d3,
                    'calendariolaboral3_id'=>$v->calendariolaboral3_id,
                    'd4'=>$v->d4,
                    'calendariolaboral4_id'=>$v->calendariolaboral4_id,
                    'd5'=>$v->d5,
                    'calendariolaboral5_id'=>$v->calendariolaboral5_id,
                    'd6'=>$v->d6,
                    'calendariolaboral6_id'=>$v->calendariolaboral6_id,
                    'd7'=>$v->d7,
                    'calendariolaboral7_id'=>$v->calendariolaboral7_id,
                    'd8'=>$v->d8,
                    'calendariolaboral8_id'=>$v->calendariolaboral8_id,
                    'd9'=>$v->d9,
                    'calendariolaboral9_id'=>$v->calendariolaboral9_id,
                    'd10'=>$v->d10,
                    'calendariolaboral10_id'=>$v->calendariolaboral10_id,
                    'd11'=>$v->d11,
                    'calendariolaboral11_id'=>$v->calendariolaboral11_id,
                    'd12'=>$v->d12,
                    'calendariolaboral12_id'=>$v->calendariolaboral12_id,
                    'd13'=>$v->d13,
                    'calendariolaboral13_id'=>$v->calendariolaboral13_id,
                    'd14'=>$v->d14,
                    'calendariolaboral14_id'=>$v->calendariolaboral14_id,
                    'd15'=>$v->d15,
                    'calendariolaboral15_id'=>$v->calendariolaboral15_id,
                    'd16'=>$v->d16,
                    'calendariolaboral16_id'=>$v->calendariolaboral16_id,
                    'd17'=>$v->d17,
                    'calendariolaboral17_id'=>$v->calendariolaboral17_id,
                    'd18'=>$v->d18,
                    'calendariolaboral18_id'=>$v->calendariolaboral18_id,
                    'd19'=>$v->d19,
                    'calendariolaboral19_id'=>$v->calendariolaboral19_id,
                    'd20'=>$v->d20,
                    'calendariolaboral20_id'=>$v->calendariolaboral20_id,
                    'd21'=>$v->d21,
                    'calendariolaboral21_id'=>$v->calendariolaboral21_id,
                    'd22'=>$v->d22,
                    'calendariolaboral22_id'=>$v->calendariolaboral22_id,
                    'd23'=>$v->d23,
                    'calendariolaboral23_id'=>$v->calendariolaboral23_id,
                    'd24'=>$v->d24,
                    'calendariolaboral24_id'=>$v->calendariolaboral24_id,
                    'd25'=>$v->d25,
                    'calendariolaboral25_id'=>$v->calendariolaboral25_id,
                    'd26'=>$v->d26,
                    'calendariolaboral26_id'=>$v->calendariolaboral26_id,
                    'd27'=>$v->d27,
                    'calendariolaboral27_id'=>$v->calendariolaboral27_id,
                    'd28'=>$v->d28,
                    'calendariolaboral28_id'=>$v->calendariolaboral28_id,
                    'd29'=>$v->d29,
                    'calendariolaboral29_id'=>$v->calendariolaboral29_id,
                    'd30'=>$v->d30,
                    'calendariolaboral30_id'=>$v->calendariolaboral30_id,
                    'd31'=>$v->d31,
                    'calendariolaboral31_id'=>$v->calendariolaboral31_id,
                    'ultimo_dia'=>$v->ultimo_dia,
                    'atrasos'=>$v->atrasos,
                    'faltas'=>$v->faltas,
                    'abandono'=>$v->abandono,
                    'omision'=>$v->omision,
                    'lsgh'=>$v->lsgh,
                    'compensacion'=>$v->compensacion,
                    'observacion'=>$v->observacion,
                    'estado'=>$v->estado,
                    'estado_descripcion'=>$v->estado_descripcion,
                    'baja_logica'=>$v->baja_logica,
                    'agrupador'=>$v->agrupador,
                    'user_reg_id'=>$v->user_reg_id,
                    'fecha_reg'=>$v->fecha_reg,
                    'user_apr_id'=>$v->user_apr_id,
                    'fecha_apr'=>$v->fecha_apr,
                    'user_mod_id'=>$v->user_mod_id,
                    'fecha_mod'=>$v->fecha_mod,
                );
                #region sector para adicionar una fila para Excepciones
                if($v->modalidadmarcacion_id==6){
                    $d1=$d2=$d3=$d4=$d5=$d6=$d7=$d8=$d9=$d10=$d11=$d12=$d13=$d14=$d15=$d16=$d17=$d18=$d19=$d20=$d21=$d22=$d23=$d24=$d25=$d26=$d27=$d28=$d29=$d30=$d30=$d31="";
                    if($v->calendariolaboral1_id>0){
                        $res1 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,1,$v->calendariolaboral1_id,1);
                        if(is_object($res1)&&$res1->count()>0){
                            foreach($res1 as $r1){
                                $d1 = $r1->f_excepciones_en_dia;
                            }
                        }
                    }
                    if($v->calendariolaboral2_id>0){
                        $res2 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,2,$v->calendariolaboral2_id,1);
                        if(is_object($res2)&&$res2->count()>0){
                            foreach($res2 as $r2){
                                $d2 = $r2->f_excepciones_en_dia;
                            }
                        }
                    }
                    if($v->calendariolaboral3_id>0){
                        $res3 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,3,$v->calendariolaboral3_id,1);
                        if(is_object($res3)&&$res3->count()>0){
                            foreach($res3 as $r3){
                                $d3 = $r3->f_excepciones_en_dia;
                            }

                        }
                    }

                    if($v->calendariolaboral4_id>0){
                        $res4 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,4,$v->calendariolaboral4_id,1);
                        if(is_object($res4)&&$res4->count()>0){
                            foreach($res4 as $r4){
                                $d4 = $r4->f_excepciones_en_dia;
                            }
                        }
                    }
                    if($v->calendariolaboral5_id>0){
                        $res5 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,5,$v->calendariolaboral5_id,1);
                        if(is_object($res5)&&$res5->count()>0){
                            foreach($res5 as $r5){
                                $d5 = $r5->f_excepciones_en_dia;
                            }
                        }
                    }
                    if($v->calendariolaboral6_id>0){
                        $res6 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,6,$v->calendariolaboral6_id,1);
                        if(is_object($res6)&&$res6->count()>0){
                            foreach($res6 as $r6){
                                $d6 = $r6->f_excepciones_en_dia;
                            }
                        }
                    }
                    if($v->calendariolaboral7_id>0){
                        $res7 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,7,$v->calendariolaboral7_id,1);
                        if(is_object($res7)&&$res7->count()>0){
                            foreach($res7 as $r7){
                                $d7 = $r7->f_excepciones_en_dia;
                            }
                        }
                    }
                    if($v->calendariolaboral8_id>0){
                        $res8 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,8,$v->calendariolaboral8_id,1);
                        if(is_object($res8)&&$res8->count()>0){
                            foreach($res8 as $r8){
                                $d8 = $r8->f_excepciones_en_dia;
                            }
                        }
                    }
                    if($v->calendariolaboral9_id>0){
                        $res9 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,9,$v->calendariolaboral9_id,1);
                        if(is_object($res9)&&$res9->count()>0){
                            foreach($res9 as $r9){
                                $d9 = $r9->f_excepciones_en_dia;
                            }
                        }
                    }
                    if($v->calendariolaboral10_id>0){
                        $res10 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,10,$v->calendariolaboral10_id,1);
                        if(is_object($res10)&&$res10->count()>0){
                            foreach($res10 as $r10){
                                $d10 = $r10->f_excepciones_en_dia;
                            }
                        }
                    }
                    if($v->calendariolaboral11_id>0){
                        $res11 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,11,$v->calendariolaboral11_id,1);
                        if(is_object($res11)&&$res11->count()>0){
                            foreach($res11 as $r11){
                                $d11 = $r11->f_excepciones_en_dia;
                            }
                        }
                    }
                    if($v->calendariolaboral12_id>0){
                        $res12 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,12,$v->calendariolaboral12_id,1);
                        if(is_object($res12)&&$res12->count()>0){
                            foreach($res12 as $r12){
                                $d12 = $r12->f_excepciones_en_dia;
                            }
                        }
                    }

                    if($v->calendariolaboral13_id>0){
                        $res13 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,13,$v->calendariolaboral13_id,1);
                        if(is_object($res13)&&$res13->count()>0){
                            foreach($res13 as $r13){
                                $d13 = $r13->f_excepciones_en_dia;
                            }
                        }
                    }

                    if($v->calendariolaboral14_id>0){
                        $res14 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,14,$v->calendariolaboral14_id,1);
                        if(is_object($res14)&&$res14->count()>0){
                            foreach($res14 as $r14){
                                $d14 = $r14->f_excepciones_en_dia;
                            }
                        }
                    }
                    if($v->calendariolaboral15_id>0){
                        $res15 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,15,$v->calendariolaboral15_id,1);
                        if(is_object($res15)&&$res15->count()>0){
                            foreach($res15 as $r15){
                                $d15 = $r15->f_excepciones_en_dia;
                            }
                        }
                    }
                    if($v->calendariolaboral16_id>0){
                        $res16 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,16,$v->calendariolaboral16_id,1);
                        if(is_object($res16)&&$res16->count()>0){
                            foreach($res16 as $r16){
                                $d16 = $r16->f_excepciones_en_dia;
                            }
                        }
                    }
                    if($v->calendariolaboral17_id>0){
                        $res17 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,17,$v->calendariolaboral17_id,1);
                        if(is_object($res17)&&$res17->count()>0){
                            foreach($res17 as $r17){
                                $d17 = $r17->f_excepciones_en_dia;
                            }
                        }
                    }
                    if($v->calendariolaboral18_id>0){
                        $res18 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,18,$v->calendariolaboral18_id,1);
                        if(is_object($res18)&&$res18->count()>0){
                            foreach($res18 as $r){
                                $d18 = $r->f_excepciones_en_dia;
                            }
                        }
                    }
                    if($v->calendariolaboral19_id>0){
                        $res19 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,19,$v->calendariolaboral19_id,1);
                        if(is_object($res19)&&$res19->count()>0){
                            foreach($res19 as $r){
                                $d19 = $r->f_excepciones_en_dia;
                            }
                        }
                    }
                    if($v->calendariolaboral20_id>0){
                        $res20 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,20,$v->calendariolaboral20_id,1);
                        if(is_object($res20)&&$res20->count()>0){
                            foreach($res20 as $r){
                                $d20 = $r->f_excepciones_en_dia;
                            }
                        }
                    }
                    if($v->calendariolaboral21_id>0){
                        $res21 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,21,$v->calendariolaboral21_id,1);
                        if(is_object($res21)&&$res21->count()>0){
                            foreach($res21 as $r21){
                                $d21 = $r21->f_excepciones_en_dia;
                            }
                        }
                    }
                    if($v->calendariolaboral22_id>0){
                        $res22 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,22,$v->calendariolaboral22_id,1);
                        if(is_object($res22)&&$res22->count()>0){
                            foreach($res22 as $r22){
                                $d22 = $r22->f_excepciones_en_dia;
                            }
                        }
                    }
                    if($v->calendariolaboral23_id>0){
                        $res23 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,23,$v->calendariolaboral23_id,1);
                        if(is_object($res23)&&$res23->count()>0){
                            foreach($res23 as $r23){
                                $d23 = $r23->f_excepciones_en_dia;
                            }
                        }
                    }
                    if($v->calendariolaboral24_id>0){
                        $res24 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,24,$v->calendariolaboral24_id,1);
                        if(is_object($res24)&&$res24->count()>0){
                            foreach($res24 as $r24){
                                $d24 = $r24->f_excepciones_en_dia;
                            }
                        }
                    }
                    if($v->calendariolaboral25_id>0){
                        $res25 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,25,$v->calendariolaboral25_id,1);
                        if(is_object($res25)&&$res25->count()>0){
                            foreach($res25 as $r25){
                                $d25 = $r25->f_excepciones_en_dia;
                            }
                        }
                    }
                    if($v->calendariolaboral26_id>0){
                        $res26 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,26,$v->calendariolaboral26_id,1);
                        if(is_object($res26)&&$res26->count()>0){
                            foreach($res26 as $r26){
                                $d26 = $r26->f_excepciones_en_dia;
                            }
                        }
                    }
                    if($v->calendariolaboral27_id>0){
                        $res27 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,27,$v->calendariolaboral27_id,1);
                        if(is_object($res27)&&$res27->count()>0){
                            foreach($res27 as $r27){
                                $d27 = $r27->f_excepciones_en_dia;
                            }
                        }
                    }
                    if($v->calendariolaboral28_id>0){
                        $res28 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,28,$v->calendariolaboral28_id,1);
                        if(is_object($res28)&&$res28->count()>0){
                            foreach($res28 as $r28){
                                $d28 = $r28->f_excepciones_en_dia;
                            }
                        }
                    }
                    if($v->calendariolaboral29_id>0){
                        $res29 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,29,$v->calendariolaboral29_id,1);
                        if(is_object($res29)&&$res29->count()>0){
                            foreach($res29 as $r29){
                                $d29 = $r29->f_excepciones_en_dia;
                            }
                        }
                    }
                    if($v->calendariolaboral30_id>0){
                        $res30 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,30,$v->calendariolaboral30_id,1);
                        if(is_object($res30)&&$res30->count()>0){
                            foreach($res30 as $r30){
                                $d30 = $r30->f_excepciones_en_dia;
                            }
                        }
                    }
                    if($v->calendariolaboral31_id>0){
                        $res31 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,31,$v->calendariolaboral31_id,1);
                        if(is_object($res31)&&$res31->count()>0){
                            foreach($res31 as $r31){
                                $d31 = $r31->f_excepciones_en_dia;
                            }
                        }
                    }
                    $horariosymarcaciones[] = array(
                        'id'=>$v->id_horarioymarcacion,
                        'relaboral_id'=>$v->relaboral_id,
                        'gestion'=>$v->gestion,
                        'mes'=>$v->mes,
                        'mes_nombre'=>$v->mes_nombre,
                        'turno'=>$v->turno,
                        'grupo'=>$v->grupo,
                        'clasemarcacion'=>"e",
                        'clasemarcacion_descripcion'=>"EXCEPCIONES",
                        'modalidadmarcacion_id'=>$v->modalidadmarcacion_id,
                        'modalidad_marcacion'=>"EXCEPCIONES",
                        'd1'=>$d1,
                        'calendariolaboral1_id'=>$v->calendariolaboral1_id,
                        'd2'=>$d2,
                        'calendariolaboral2_id'=>$v->calendariolaboral2_id,
                        'd3'=>$d3,
                        'calendariolaboral3_id'=>$v->calendariolaboral3_id,
                        'd4'=>$d4,
                        'calendariolaboral4_id'=>$v->calendariolaboral4_id,
                        'd5'=>$d5,
                        'calendariolaboral5_id'=>$v->calendariolaboral5_id,
                        'd6'=>$d6,
                        'calendariolaboral6_id'=>$v->calendariolaboral6_id,
                        'd7'=>$d7,
                        'calendariolaboral7_id'=>$v->calendariolaboral7_id,
                        'd8'=>$d8,
                        'calendariolaboral8_id'=>$v->calendariolaboral8_id,
                        'd9'=>$d9,
                        'calendariolaboral9_id'=>$v->calendariolaboral9_id,
                        'd10'=>$d10,
                        'calendariolaboral10_id'=>$v->calendariolaboral10_id,
                        'd11'=>$d11,
                        'calendariolaboral11_id'=>$v->calendariolaboral11_id,
                        'd12'=>$d12,
                        'calendariolaboral12_id'=>$v->calendariolaboral12_id,
                        'd13'=>$d13,
                        'calendariolaboral13_id'=>$v->calendariolaboral13_id,
                        'd14'=>$d14,
                        'calendariolaboral14_id'=>$v->calendariolaboral14_id,
                        'd15'=>$d15,
                        'calendariolaboral15_id'=>$v->calendariolaboral15_id,
                        'd16'=>$d16,
                        'calendariolaboral16_id'=>$v->calendariolaboral16_id,
                        'd17'=>$d17,
                        'calendariolaboral17_id'=>$v->calendariolaboral17_id,
                        'd18'=>$d18,
                        'calendariolaboral18_id'=>$v->calendariolaboral18_id,
                        'd19'=>$d19,
                        'calendariolaboral19_id'=>$v->calendariolaboral19_id,
                        'd20'=>$d20,
                        'calendariolaboral20_id'=>$v->calendariolaboral20_id,
                        'd21'=>$d21,
                        'calendariolaboral21_id'=>$v->calendariolaboral21_id,
                        'd22'=>$d22,
                        'calendariolaboral22_id'=>$v->calendariolaboral22_id,
                        'd23'=>$d23,
                        'calendariolaboral23_id'=>$v->calendariolaboral23_id,
                        'd24'=>$d24,
                        'calendariolaboral24_id'=>$v->calendariolaboral24_id,
                        'd25'=>$d25,
                        'calendariolaboral25_id'=>$v->calendariolaboral25_id,
                        'd26'=>$d26,
                        'calendariolaboral26_id'=>$v->calendariolaboral26_id,
                        'd27'=>$d27,
                        'calendariolaboral27_id'=>$v->calendariolaboral27_id,
                        'd28'=>$d28,
                        'calendariolaboral28_id'=>$v->calendariolaboral28_id,
                        'd29'=>$d29,
                        'calendariolaboral29_id'=>$v->calendariolaboral29_id,
                        'd30'=>$d30,
                        'calendariolaboral30_id'=>$v->calendariolaboral30_id,
                        'd31'=>$d31,
                        'calendariolaboral31_id'=>$v->calendariolaboral31_id,
                        'ultimo_dia'=>$v->ultimo_dia,
                        'atrasos'=>null,
                        'faltas'=>null,
                        'abandono'=>null,
                        'omision'=>null,
                        'lsgh'=>null,
                        'compensacion'=>null,
                        'observacion'=>$v->observacion,
                        'estado'=>$v->estado,
                        'estado_descripcion'=>$v->estado_descripcion,
                        'baja_logica'=>$v->baja_logica,
                        'agrupador'=>$v->agrupador,
                        'user_reg_id'=>$v->user_reg_id,
                        'fecha_reg'=>$v->fecha_reg,
                        'user_apr_id'=>$v->user_apr_id,
                        'fecha_apr'=>$v->fecha_apr,
                        'user_mod_id'=>$v->user_mod_id,
                        'fecha_mod'=>$v->fecha_mod,
                    );
                }
                #endregion sector para adicionar una fila para Excepciones
            }
            #region Espacio para la definición de valores para la cabecera de la tabla
            $excel->FechaHoraReporte = date("d-m-Y H:i:s");
            $j = 0;
            $agrupadores = array();
            if ($groups != "")
                $agrupadores = explode(",", $groups);

            $dondeCambio = array();
            $queCambio = array();
            $excel->header();
            $fila=$excel->numFilaCabeceraTabla;
            if (count($horariosymarcaciones) > 0){
                $excel->RowTitle($colTitleSelecteds,$fila);
                $celdaInicial=$excel->primeraLetraCabeceraTabla.$fila;
                $celdaFinalDiagonalTabla=$excel->ultimaLetraCabeceraTabla.$fila;
                if ($excel->debug == 1) {
                    echo "<p>|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||<p></p>";
                    print_r($horariosymarcaciones);
                    echo "<p>|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||<p></p>";
                }
                foreach ($horariosymarcaciones as $i => $val) {
                    if (count($agrupadores) > 0) {
                        if ($excel->debug == 1) {
                            echo "<p>|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||<p></p>";
                            print_r($gruposSeleccionadosActuales);
                            echo "<p>|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||<p></p>";
                        }
                        $agregarAgrupador = 0;
                        $aux = array();
                        $dondeCambio = array();
                        foreach ($gruposSeleccionadosActuales as $key => $valor) {
                            if ($valor != $val[$key]) {
                                $agregarAgrupador = 1;
                                $aux[$key] = $val[$key];
                                $dondeCambio[] = $key;
                                $queCambio[$key] = $val[$key];
                            } else {
                                $aux[$key] = $val[$key];
                            }
                        }
                        $gruposSeleccionadosActuales = $aux;
                        if ($agregarAgrupador == 1) {
                            $agr = $excel->DefineTitleColsByGroups($generalConfigForAllColumns, $dondeCambio, $queCambio);
                            if($excel->debug==1){
                                echo "<p>+++++++++++++++++++++++++++AGRUPADO POR++++++++++++++++++++++++++++++++++++++++<p></p>";
                                print_r($agr);
                                echo "<p>+++++++++++++++++++++++++++AGRUPADO POR++++++++++++++++++++++++++++++++++++++++<p></p>";
                            }
                            $excel->borderGroup($celdaInicial,$celdaFinalDiagonalTabla);
                            $fila++;
                            /*
                             * Si es que hay agrupadores, se inicia el conteo desde donde empieza el agrupador
                             */
                            $celdaInicial=$excel->primeraLetraCabeceraTabla.$fila;
                            $excel->Agrupador($agr,$fila);
                            $excel->RowTitle($colTitleSelecteds,$fila);
                        }
                        $celdaFinalDiagonalTabla=$excel->ultimaLetraCabeceraTabla.$fila;
                        $rowData = $excel->DefineRows($j + 1, $horariosymarcaciones[$j], $colSelecteds);
                        if ($excel->debug == 1) {
                            echo "<p>···································FILA·················································<p></p>";
                            print_r($rowData);
                            echo "<p>···································FILA·················································<p></p>";
                        }
                        $excel->Row($rowData,$alignSelecteds,$formatTypes,$fila);
                        $fila++;

                    } else {
                        $celdaFinalDiagonalTabla=$excel->ultimaLetraCabeceraTabla.$fila;
                        $rowData = $excel->DefineRows($j + 1, $val, $colSelecteds);
                        if ($excel->debug == 1) {
                            echo "<p>···································FILA DATA·················································<p></p>";
                            print_r($rowData);
                            echo "<p>···································FILA DATA·················································<p></p>";
                        }
                        $celdacolores = array();
                        if($rowData[0]%7 == 0){
                            if($excel->debug==1){
                                echo "<p>xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx</p>";
                            }
                            for($i=1;$i<=31;$i++){
                                if(in_array("d".$i,$colSelecteds)){
                                    $clave = array_search("d".$i,$colSelecteds);
                                    if(isset($rowData[$clave])&&$rowData[$clave]!=''){
                                        $celdacolores[$clave] = "FF00FF00";
                                    }
                                }
                            }
                            if($excel->debug==1){
                                print_r($celdacolores);
                                echo "<p>xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx</p>";
                            }
                        }
                        $excel->Row($rowData,$alignSelecteds,$formatTypes,$fila,$celdacolores);
                        $fila++;
                    }
                    $j++;
                }
                $fila--;
                $celdaFinalDiagonalTabla=$excel->ultimaLetraCabeceraTabla.$fila;
                $excel->borderGroup($celdaInicial,$celdaFinalDiagonalTabla);
            }
            $excel->ShowLeftFooter = true;
            //$excel->secondPage();
            if ($excel->debug == 0) {
                $excel->display("AppData/reporte_marcaciones.xls","I");
            }
            #endregion Proceso de generación del documento PDF
        }
    }
    /**
     * Función para la exportación del reporte con cálculos en rango de fechas en formato Excel.
     * @param $ci Número de carnet de identidad
     * @param $fechaIni Fecha de inicio del rango para el reporte.
     * @param $fechaFin Fecha de finalización del rango para el reporte.
     * @param $columns Array con las columnas mostradas en el reporte
     * @param $filtros Array con los filtros aplicados sobre las columnas.
     * @param $groups String con la cadena representativa de las columnas agrupadas. La separación es por comas.
     * @param $sorteds  Columnas ordenadas .
     */
    public function exportcalculosexcelAction($ci,$fechaIni,$fechaFin,$n_rows, $columns, $filtros,$groups,$sorteds)
    {   $columns = base64_decode(str_pad(strtr($columns, '-_', '+/'), strlen($columns) % 4, '=', STR_PAD_RIGHT));
        $filtros = base64_decode(str_pad(strtr($filtros, '-_', '+/'), strlen($columns) % 4, '=', STR_PAD_RIGHT));
        $groups = base64_decode(str_pad(strtr($groups, '-_', '+/'), strlen($groups) % 4, '=', STR_PAD_RIGHT));
        if($groups=='null'||$groups==null)$groups="";
        $sorteds = base64_decode(str_pad(strtr($sorteds, '-_', '+/'), strlen($sorteds) % 4, '=', STR_PAD_RIGHT));
        $columns = json_decode($columns, true);
        $filtros = json_decode($filtros, true);
        $sub_keys = array_keys($columns);//echo $sub_keys[0];
        $n_col = count($columns);//echo$keys[1];
        $sorteds = json_decode($sorteds, true);
        /**
         * Especificando la configuración de las columnas
         */
        $generalConfigForAllColumns = array(
            'nro_row' => array('title' => 'Nro.', 'width' => 8, 'title-align'=>'C','align' => 'C', 'type' => 'int4','totales'=>false),
            'ubicacion' => array('title' => 'Ubicacion', 'width' => 20, 'align' => 'C', 'type' => 'varchar','totales'=>false),
            'condicion' => array('title' => 'Condicion', 'width' => 20, 'align' => 'C', 'type' => 'varchar','totales'=>false),
            'nombres' => array('title' => 'Nombres', 'width' => 30, 'align' => 'L', 'type' => 'varchar','totales'=>true),
            'ci' => array('title' => 'CI', 'width' => 15, 'align' => 'C', 'type' => 'varchar','totales'=>true),
            'expd' => array('title' => 'Exp.', 'width' => 8, 'align' => 'C', 'type' => 'bpchar','totales'=>true),
            'gerencia_administrativa' => array('title' => 'Gerencia', 'width' => 30, 'align' => 'L', 'type' => 'varchar','totales'=>true),
            'departamento_administrativo' => array('title' => 'Departamento', 'width' => 30, 'align' => 'L', 'type' => 'varchar','totales'=>true),
            'area' => array('title' => 'Area', 'width' => 20, 'align' => 'L', 'type' => 'varchar','totales'=>true),
            'cargo' => array('title' => 'Cargo', 'width' => 30, 'align' => 'L', 'type' => 'varchar','totales'=>true),
            'sueldo' => array('title' => 'Haber', 'width' => 10, 'align' => 'R', 'type' => 'numeric','totales'=>true),
            'estado_descripcion' => array('title' => 'Estado', 'width' => 15, 'align' => 'C', 'type' => 'varchar','totales'=>false),
            'gestion' => array('title' => 'Gestion', 'width' => 15, 'align' => 'C', 'type' => 'numeric','totales'=>true),
            'mes_nombre' => array('title' => 'Mes', 'width' => 20, 'align' => 'C', 'type' => 'varchar','totales'=>true),
            'turno' => array('title' => 'Turno', 'width' => 10, 'align' => 'C', 'type' => 'numeric','totales'=>false),
            'modalidad_marcacion' => array('title' => 'Modalidad', 'width' => 30, 'align' => 'C', 'type' => 'varchar','totales'=>false),
            'd1' => array('title' => 'Dia 1', 'width' => 18, 'align' => 'C', 'type' => 'date','totales'=>false),
            /*'estado1_descripcion' => array('title' => 'Estado Dia 1', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd2' => array('title' => 'Dia 2', 'width' => 18, 'align' => 'C', 'type' => 'date','totales'=>false),
            /*'estado2_descripcion' => array('title' => 'Estado Dia 2', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd3' => array('title' => 'Dia 3', 'width' => 18, 'align' => 'C', 'type' => 'date','totales'=>false),
            /*'estado3_descripcion' => array('title' => 'Estado Dia 3', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd4' => array('title' => 'Dia 4', 'width' => 18, 'align' => 'C', 'type' => 'date','totales'=>false),
            /*'estado4_descripcion' => array('title' => 'Estado Dia 4', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd5' => array('title' => 'Dia 5', 'width' => 18, 'align' => 'C', 'type' => 'date','totales'=>false),
            /*'estado5_descripcion' => array('title' => 'Estado Dia 5', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd6' => array('title' => 'Dia 6', 'width' => 18, 'align' => 'C', 'type' => 'date','totales'=>false),
            /*'estado6_descripcion' => array('title' => 'Estado Dia 6', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd7' => array('title' => 'Dia 7', 'width' => 18, 'align' => 'C', 'type' => 'date','totales'=>false),
            /*'estado7_descripcion' => array('title' => 'Estado Dia 7', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd8' => array('title' => 'Dia 8', 'width' => 18, 'align' => 'C', 'type' => 'date','totales'=>false),
            /*'estado8_descripcion' => array('title' => 'Estado Dia 8', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd9' => array('title' => 'Dia 9', 'width' => 18, 'align' => 'C', 'type' => 'date','totales'=>false),
            /*'estado9_descripcion' => array('title' => 'Estado Dia 9', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd10' => array('title' => 'Dia 10', 'width' => 18, 'align' => 'C', 'type' => 'date','totales'=>false),
            /*'estado10_descripcion' => array('title' => 'Estado Dia 10', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd11' => array('title' => 'Dia 11', 'width' => 18, 'align' => 'C', 'type' => 'date','totales'=>false),
            /*'estado11_descripcion' => array('title' => 'Estado Dia 11', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd12' => array('title' => 'Dia 12', 'width' => 18, 'align' => 'C', 'type' => 'date','totales'=>false),
            /*'estado12_descripcion' => array('title' => 'Estado Dia 12', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd13' => array('title' => 'Dia 13', 'width' => 18, 'align' => 'C', 'type' => 'date','totales'=>false),
            /*'estado13_descripcion' => array('title' => 'Estado Dia 13', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd14' => array('title' => 'Dia 14', 'width' => 18, 'align' => 'C', 'type' => 'date','totales'=>false),
            /*'estado14_descripcion' => array('title' => 'Estado Dia 14', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd15' => array('title' => 'Dia 15', 'width' => 18, 'align' => 'C', 'type' => 'date','totales'=>false),
            /*'estado15_descripcion' => array('title' => 'Estado Dia 15', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd16' => array('title' => 'Dia 16', 'width' => 18, 'align' => 'C', 'type' => 'date','totales'=>false),
            /*'estado16_descripcion' => array('title' => 'Estado Dia 16', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd17' => array('title' => 'Dia 17', 'width' => 18, 'align' => 'C', 'type' => 'date','totales'=>false),
            /*'estado17_descripcion' => array('title' => 'Estado Dia 17', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd18' => array('title' => 'Dia 18', 'width' => 18, 'align' => 'C', 'type' => 'date','totales'=>false),
            /*'estado18_descripcion' => array('title' => 'Estado Dia 18', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd19' => array('title' => 'Dia 19', 'width' => 18, 'align' => 'C', 'type' => 'date','totales'=>false),
            /*'estado19_descripcion' => array('title' => 'Estado Dia 19', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd20' => array('title' => 'Dia 20', 'width' => 18, 'align' => 'C', 'type' => 'date','totales'=>false),
            /*'estado20_descripcion' => array('title' => 'Estado Dia 20', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd21' => array('title' => 'Dia 21', 'width' => 18, 'align' => 'C', 'type' => 'date','totales'=>false),
            /*'estado21_descripcion' => array('title' => 'Estado Dia 21', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd22' => array('title' => 'Dia 22', 'width' => 18, 'align' => 'C', 'type' => 'date','totales'=>false),
            /*'estado22_descripcion' => array('title' => 'Estado Dia 22', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd23' => array('title' => 'Dia 23', 'width' => 18, 'align' => 'C', 'type' => 'date','totales'=>false),
            /*'estado23_descripcion' => array('title' => 'Estado Dia 23', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd24' => array('title' => 'Dia 24', 'width' => 18, 'align' => 'C', 'type' => 'date','totales'=>false),
            /*'estado24_descripcion' => array('title' => 'Estado Dia 24', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd25' => array('title' => 'Dia 25', 'width' => 18, 'align' => 'C', 'type' => 'date','totales'=>false),
            /*'estado25_descripcion' => array('title' => 'Estado Dia 25', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd26' => array('title' => 'Dia 26', 'width' => 18, 'align' => 'C', 'type' => 'date','totales'=>false),
            /*'estado26_descripcion' => array('title' => 'Estado Dia 26', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd27' => array('title' => 'Dia 27', 'width' => 18, 'align' => 'C', 'type' => 'date','totales'=>false),
            /*'estado27_descripcion' => array('title' => 'Estado Dia 27', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd28' => array('title' => 'Dia 28', 'width' => 18, 'align' => 'C', 'type' => 'date','totales'=>false),
            /*'estado28_descripcion' => array('title' => 'Estado Dia 28', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd29' => array('title' => 'Dia 29', 'width' => 18, 'align' => 'C', 'type' => 'date','totales'=>false),
            /*'estado29_descripcion' => array('title' => 'Estado Dia 29', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd30' => array('title' => 'Dia 30', 'width' => 18, 'align' => 'C', 'type' => 'date','totales'=>false),
            /*'estado30_descripcion' => array('title' => 'Estado Dia 30', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd31' => array('title' => 'Dia 31', 'width' => 18, 'align' => 'C', 'type' => 'date','totales'=>false),
            /*'estado31_descripcion' => array('title' => 'Estado Dia 31', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'ultimo_dia' => array('title' => 'U/Dia', 'width' => 10, 'align' => 'C', 'type' => 'numeric','totales'=>false),
            'atrasos' => array('title' => 'Atrasos', 'width' => 15, 'align' => 'C', 'type' => 'numeric','totales'=>true),
            'faltas' => array('title' => 'Faltas', 'width' => 15, 'align' => 'C', 'type' => 'numeric','totales'=>true),
            'abandono' => array('title' => 'Abandono', 'width' => 18, 'align' => 'C', 'type' => 'numeric','totales'=>true),
            'omision' => array('title' => 'Omision', 'width' => 15, 'align' => 'C', 'type' => 'numeric','totales'=>true),
            'lsgh' => array('title' => 'LSGH', 'width' => 15, 'align' => 'C', 'type' => 'numeric','totales'=>true),
            'observacion' => array('title' => 'Obs.', 'width' => 30, 'align' => 'L', 'type' => 'varchar','totales'=>false)
        );
        $agruparPor = ($groups!="")?explode(",",$groups):array();
        $widthsSelecteds = $this->DefineWidths($generalConfigForAllColumns, $columns,$agruparPor);
        $ancho = 0;
        if($fechaIni!=""&&$fechaFin!=""&&count($widthsSelecteds)>0) {
            foreach ($widthsSelecteds as $w) {
                $ancho = $ancho + $w;
            }
            $excel = new exceloasis();
            $excel->tableWidth = $ancho;
            #region Proceso de generación del documento Excel
            $excel->debug = 0;
            $excel->title_rpt = utf8_decode('Reporte Rango Marcaciones ('.$fechaIni.' al '.$fechaFin.')');
            $excel->title_total_rpt = utf8_decode('Cuadro Resumen de Datos Marcaciones ('.$fechaIni.' al '.$fechaFin.')');
            $excel->header_title_empresa_rpt = utf8_decode('Empresa Estatal de Transporte por Cable "Mi Teleférico"');
            $alignSelecteds = $excel->DefineAligns($generalConfigForAllColumns, $columns, $agruparPor);
            $colSelecteds = $excel->DefineCols($generalConfigForAllColumns, $columns, $agruparPor);
            $colTitleSelecteds = $excel->DefineTitleCols($generalConfigForAllColumns, $columns, $agruparPor);
            $alignTitleSelecteds = $excel->DefineTitleAligns(count($colTitleSelecteds));
            $formatTypes = $excel->DefineTypeCols($generalConfigForAllColumns, $columns, $agruparPor);
            $gruposSeleccionadosActuales = $excel->DefineDefaultValuesForGroups($groups);
            $excel->generalConfigForAllColumns = $generalConfigForAllColumns;
            $excel->colTitleSelecteds = $colTitleSelecteds;
            if ($excel->debug == 1) {
                echo "<p>^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^COLUMNAS A MOSTRARSE^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^(".count($colSelecteds).")</p>";
                print_r($colSelecteds);
                echo "<p>^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^";
            }
            $excel->widthsSelecteds = $widthsSelecteds;
            $excel->alignSelecteds = $alignSelecteds;
            $excel->alignTitleSelecteds = $alignTitleSelecteds;

            $cantCol = count($colTitleSelecteds);
            $excel->ultimaLetraCabeceraTabla = $excel->columnasExcel[$cantCol-1];
            $excel->penultimaLetraCabeceraTabla = $excel->columnasExcel[$cantCol-2];
            $excel->numFilaCabeceraTabla = 4;
            $excel->primeraLetraCabeceraTabla = "A";
            $excel->segundaLetraCabeceraTabla = "B";
            $excel->celdaInicial = $excel->primeraLetraCabeceraTabla.$excel->numFilaCabeceraTabla;
            $excel->celdaFinal = $excel->ultimaLetraCabeceraTabla.$excel->numFilaCabeceraTabla;
            if($cantCol<=9){
                $excel->defineOrientation("V");
                $excel->defineSize("C");
            }elseif($cantCol<=13){
                $excel->defineOrientation("H");
                $excel->defineSize("C");
            }else{
                $excel->defineOrientation("H");
                $excel->defineSize("O");
            }
            if ($excel->debug == 1) {
                echo "<p>^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^Rango Fechas^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^</p>";
                echo $fechaIni."<-->".$fechaFin;
                echo "<p>^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^";
                echo "<p>::::::::::::::::::::::::::::::::::::::::::::TOTAL COLUMNAS::::::::::::::::::::::::::::::::::::::::::<p>";
                print_r($columns);
                echo "<p>::::::::::::::::::::::::::::::::::::::::::::FILTROS::::::::::::::::::::::::::::::::::::::::::<p>";
                print_r($filtros);
                echo "<p>::::::::::::::::::::::::::::::::::::::::::::GRUPOS::::::::::::::::::::::::::::::::::::::::::::<p>";
                echo "<p>" . $groups;
                echo "<p>::::::::::::::::::::::::::::::::::::::::::::ORDEN::::::::::::::::::::::::::::::::::::::::::::<p>";
                print_r($sorteds);
                echo "<p>:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::<p>";
            }
            $where = '';
            $yaConsiderados = array();
            for ($k = 0; $k < count($filtros); $k++) {
                $cant = $this->obtieneCantidadVecesConsideracionPorColumnaEnFiltros($filtros[$k]['columna'], $filtros);
                $arr_val = $this->obtieneValoresConsideradosPorColumnaEnFiltros($filtros[$k]['columna'], $filtros);

                for ($j = 0; $j < $n_col; $j++) {
                    if ($sub_keys[$j] == $filtros[$k]['columna']) {
                        $col_fil = $columns[$sub_keys[$j]]['text'];
                    }
                }
                if ($filtros[$k]['tipo'] == 'datefilter') {
                    $filtros[$k]['valor'] = date("Y-m-d", strtotime($filtros[$k]['valor']));
                }
                $cond_fil = ' ' . $col_fil;
                if (!in_array($filtros[$k]['columna'], $yaConsiderados)) {

                    if (strlen($where) > 0) {
                        switch ($filtros[$k]['condicion']) {
                            case 'EMPTY':
                                $where .= ' AND ';
                                break;
                            case 'NOT_EMPTY':
                                $where .= ' AND ';
                                break;
                            case 'CONTAINS':
                                $where .= ' AND ';
                                break;
                            case 'EQUAL':
                                $where .= ' AND ';
                                break;
                            case 'GREATER_THAN_OR_EQUAL':
                                $where .= ' AND ';
                                break;
                            case 'LESS_THAN_OR_EQUAL':
                                $where .= ' AND ';
                                break;
                        }
                    }
                }
                if ($cant > 1) {
                    if ($excel->debug == 1) {
                        echo "<p>::::::::::::::::::::::::::::::::::::YA CONSIDERADOS:::::::::::::::::::::::::::::::::::::::::::::::<p>";
                        print_r($yaConsiderados);
                        echo "<p>::::::::::::::::::::::::::::::::::::YA CONSIDERADOS:::::::::::::::::::::::::::::::::::::::::::::::<p>";
                    }
                    if (!in_array($filtros[$k]['columna'], $yaConsiderados)) {
                        switch ($filtros[$k]['condicion']) {
                            case 'EMPTY':
                                $cond_fil .= utf8_encode(" que sea vacía ");
                                $where .= "(" . $filtros[$k]['columna'] . " IS NULL OR " . $filtros[$k]['columna'] . " ILIKE '')";
                                break;
                            case 'NOT_EMPTY':
                                $cond_fil .= utf8_encode(" que no sea vacía ");
                                $where .= "(" . $filtros[$k]['columna'] . " IS NOT NULL OR " . $filtros[$k]['columna'] . " NOT ILIKE '')";
                                break;
                            case 'CONTAINS':
                                $cond_fil .= utf8_encode(" que contenga el valor:  " . $filtros[$k]['valor']);
                                if ($filtros[$k]['columna'] == "nombres") {
                                    $where .= "(p_nombre ILIKE '%" . $filtros[$k]['valor'] . "%' OR s_nombre ILIKE '%" . $filtros[$k]['valor'] . "%' OR t_nombre ILIKE '%" . $filtros[$k]['valor'] . "%' OR p_apellido ILIKE '%" . $filtros[$k]['valor'] . "%' OR s_apellido ILIKE '%" . $filtros[$k]['valor'] . "%' OR c_apellido ILIKE '%" . $filtros[$k]['valor'] . "%')";
                                } else {
                                    $where .= $filtros[$k]['columna'] . " ILIKE '%" . $filtros[$k]['valor'] . "%'";
                                }
                                break;
                            case 'EQUAL':
                                $cond_fil .= utf8_encode(" que contenga el valor:  " . $filtros[$k]['valor']);
                                $ini = 0;
                                foreach ($arr_val as $col) {
                                    if ($excel->debug == 1) {

                                        echo "<p>.........................recorriendo las columnas multiseleccionadas: .............................................";
                                        echo $filtros[$k]['columna'] . "-->" . $col;
                                        echo "<p>.........................recorriendo las columnas multiseleccionadas: .............................................";
                                    }
                                    if (isset($generalConfigForAllColumns[$filtros[$k]['columna']]['type'])) {
                                        //$where .= $filtros[$k]['columna']." ILIKE '".$filtros[$k]['valor']."'";
                                        if ($ini == 0) {
                                            $where .= " (";
                                        }
                                        switch (@$generalConfigForAllColumns[$filtros[$k]['columna']]['type']) {
                                            case 'int4':
                                            case 'numeric':
                                            case 'date':
                                                //$whereEqueals .= $filtros[$k]['columna']." = '".$filtros[$k]['valor']."'";
                                                $where .= $filtros[$k]['columna'] . " = '" . $col . "'";
                                                break;
                                            case 'varchar':
                                            case 'bpchar':
                                                //$whereEqueals .= $filtros[$k]['columna']." ILIKE '".$filtros[$k]['valor']."'";
                                                $where .= $filtros[$k]['columna'] . " ILIKE '" . $col . "'";
                                                break;
                                        }
                                        $ini++;
                                        if ($ini == count($arr_val)) {
                                            $where .= ") ";
                                        } else $where .= " OR ";
                                    }
                                }
                                break;
                            case 'GREATER_THAN_OR_EQUAL':
                                $cond_fil .= utf8_encode(" que sea mayor o igual que:  " . $filtros[$k]['valor']);
                                $ini = 0;
                                foreach ($arr_val as $col) {
                                    //$fecha = date("Y-m-d", $col);
                                    $fecha = $col;
                                    if (isset($generalConfigForAllColumns[$filtros[$k]['columna']]['type'])) {
                                        //$where .= $filtros[$k]['columna']." ILIKE '".$filtros[$k]['valor']."'";
                                        if ($ini == 0) {
                                            $where .= " (";
                                        }
                                        switch (@$generalConfigForAllColumns[$filtros[$k]['columna']]['type']) {
                                            case 'int4':
                                            case 'numeric':
                                                $where .= $filtros[$k]['columna'] . " = '" . $fecha . "'";
                                                break;
                                            case 'date':
                                                //$whereEqueals .= $filtros[$k]['columna']." = '".$filtros[$k]['valor']."'";
                                                if ($ini == 0) {
                                                    $where .= $filtros[$k]['columna'] . " BETWEEN ";
                                                } else {
                                                    $where .= " AND ";
                                                }
                                                $where .= "'" . $fecha . "'";

                                                break;
                                            case 'varchar':
                                            case 'bpchar':
                                                //$whereEqueals .= $filtros[$k]['columna']." ILIKE '".$filtros[$k]['valor']."'";
                                                $where .= $filtros[$k]['columna'] . " ILIKE '" . $col . "'";
                                                break;
                                        }
                                        $ini++;
                                        if ($ini == count($arr_val)) {
                                            $where .= ") ";
                                        }
                                    }
                                }
                                break;
                            case 'LESS_THAN_OR_EQUAL':
                                $cond_fil .= utf8_encode(" que sea menor o igual que:  " . $filtros[$k]['valor']);
                                $where .= $filtros[$k]['columna'] . ' <= "' . $filtros[$k]['valor'] . '"';
                                break;
                        }
                        $yaConsiderados[] = $filtros[$k]['columna'];
                    }
                } else {
                    switch ($filtros[$k]['condicion']) {
                        case 'EMPTY':
                            $cond_fil .= utf8_encode(" que sea vacía ");
                            $where .= "(" . $filtros[$k]['columna'] . " IS NULL OR " . $filtros[$k]['columna'] . " ILIKE '')";
                            break;
                        case 'NOT_EMPTY':
                            $cond_fil .= utf8_encode(" que no sea vacía ");
                            $where .= "(" . $filtros[$k]['columna'] . " IS NOT NULL OR " . $filtros[$k]['columna'] . " NOT ILIKE '')";
                            break;
                        case 'CONTAINS':
                            $cond_fil .= utf8_encode(" que contenga el valor:  " . $filtros[$k]['valor']);
                            if ($filtros[$k]['columna'] == "nombres") {
                                $where .= "(p_nombre ILIKE '%" . $filtros[$k]['valor'] . "%' OR s_nombre ILIKE '%" . $filtros[$k]['valor'] . "%' OR t_nombre ILIKE '%" . $filtros[$k]['valor'] . "%' OR p_apellido ILIKE '%" . $filtros[$k]['valor'] . "%' OR s_apellido ILIKE '%" . $filtros[$k]['valor'] . "%' OR c_apellido ILIKE '%" . $filtros[$k]['valor'] . "%')";
                            } else {
                                $where .= $filtros[$k]['columna'] . " ILIKE '%" . $filtros[$k]['valor'] . "%'";
                            }
                            break;
                        case 'EQUAL':
                            $cond_fil .= utf8_encode(" que contenga el valor:  " . $filtros[$k]['valor']);
                            if (isset($generalConfigForAllColumns[$filtros[$k]['columna']]['type'])) {
                                //$where .= $filtros[$k]['columna']." ILIKE '".$filtros[$k]['valor']."'";
                                switch (@$generalConfigForAllColumns[$filtros[$k]['columna']]['type']) {
                                    case 'int4':
                                    case 'numeric':
                                    case 'date':
                                        //$whereEqueals .= $filtros[$k]['columna']." = '".$filtros[$k]['valor']."'";
                                        $where .= $filtros[$k]['columna'] . " = '" . $filtros[$k]['valor'] . "'";
                                        break;
                                    case 'varchar':
                                    case 'bpchar':
                                        //$whereEqueals .= $filtros[$k]['columna']." ILIKE '".$filtros[$k]['valor']."'";
                                        $where .= $filtros[$k]['columna'] . " ILIKE '" . $filtros[$k]['valor'] . "'";
                                        break;
                                }
                            }
                            break;
                        case 'GREATER_THAN_OR_EQUAL':
                            $cond_fil .= utf8_encode(" que sea mayor o igual que:  " . $filtros[$k]['valor']);
                            $where .= $filtros[$k]['columna'] . ' >= "' . $filtros[$k]['valor'] . '"';
                            break;
                        case 'LESS_THAN_OR_EQUAL':
                            $cond_fil .= utf8_encode(" que sea menor o igual que:  " . $filtros[$k]['valor']);
                            $where .= $filtros[$k]['columna'] . ' <= "' . $filtros[$k]['valor'] . '"';
                            break;
                    }
                }

            }
            $obj = new Frelaboraleshorariosymarcaciones();
            if ($where != "") $where = " WHERE " . $where;
            $groups_aux = "";
            if ($groups != "") {
                /**
                 * Se verifica que no se considere la columna nombres debido a que contenido ya esta ordenado por las
                 * columnas p_apellido, s_apellido, c_apellido, p_anombre, s_nombre, t_nombre
                 */
                if (strrpos($groups, "nombres")) {
                    if (strrpos($groups, ",")) {
                        $arr = explode(",", $groups);
                        foreach ($arr as $val) {
                            if ($val != "nombres")
                                $groups_aux[] = $val;
                        }
                        $groups = implode(",", $groups_aux);
                    } else $groups = "";
                }
                if (is_array($sorteds) && count($sorteds) > 0) {
                    if ($groups != "") $groups .= ",";
                    $coma = "";
                    if ($excel->debug == 1) {
                        echo "<p>===========================================Orden======================================</p>";
                        print_r($sorteds);
                        echo "<p>===========================================Orden======================================</p>";
                    }
                    foreach ($sorteds as $ord => $orden) {
                        $groups .= $coma . $ord;
                        if ($orden['asc'] == '') $groups .= " ASC"; else$groups .= " DESC";
                        $coma = ",";
                    }
                }
                if ($groups != "")
                    $groups = " ORDER BY " . $groups . ",relaboral_id,gestion,mes,turno,modalidadmarcacion_id";
                if ($excel->debug == 1) echo "<p>La consulta es: " . $groups . "<p>";
            } else {
                if (is_array($sorteds) && count($sorteds) > 0) {
                    $coma = "";
                    if ($excel->debug == 1) {
                        echo "<p>===========================================Orden======================================</p>";
                        print_r($sorteds);
                        echo "<p>===========================================Orden======================================</p>";
                    }
                    foreach ($sorteds as $ord => $orden) {
                        $groups .= $coma . $ord;
                        if ($orden['asc'] == '') $groups .= " ASC"; else$groups .= " DESC";
                        $coma = ",";
                    }
                    $groups = " ORDER BY " . $groups;
                }

            }
            if($ci!=''){
                if($where!='')$where.=" AND ci='".$ci."'";
                else $where.=" WHERE ci='".$ci."'";
            }
            if ($excel->debug == 1) echo "<p>WHERE------------------------->" . $where . "<p>";
            if ($excel->debug == 1) echo "<p>GROUP BY------------------------->" . $groups . "<p>";
            $resul = $obj->getAllByRangeTwoMonth(0,$fechaIni,$fechaFin,$where,$groups);
            $arrTotales = array();
            $horariosymarcaciones = array();
            $totalAtrasos = $totalFaltas = $totalAbandono = $totalOmision = $totalLsgh = $totalCompensacion = 0;
            foreach ($resul as $v) {
                $modalidadmarcacion_id =$v->modalidadmarcacion_id;
                $horariosymarcaciones[] = array(
                    #region Columnas de procedimiento f_relaborales()
                    'id_relaboral' => $v->id_relaboral,
                    'id_persona' => $v->id_persona,
                    'p_nombre' => $v->p_nombre,
                    's_nombre' => $v->s_nombre,
                    't_nombre' => $v->t_nombre,
                    'p_apellido' => $v->p_apellido,
                    's_apellido' => $v->s_apellido,
                    'c_apellido' => $v->c_apellido,
                    'nombres' => $v->nombres,
                    'ci' => $v->ci,
                    'expd' => trim($v->expd),
                    'cargo' => $v->cargo,
                    'sueldo' => str_replace(".00", "", $v->sueldo),
                    'condicion' => $v->condicion,
                    'gerencia_administrativa' => $v->gerencia_administrativa,
                    'departamento_administrativo' => $v->departamento_administrativo,
                    'area' => $v->area,
                    'ubicacion' => $v->ubicacion,
                    #endregion Columnas de procedimiento f_relaborales()

                    'id'=>$v->id_horarioymarcacion,
                    'relaboral_id'=>$v->relaboral_id,
                    'gestion'=>$v->gestion,
                    'mes'=>$v->mes,
                    'mes_nombre'=>$v->mes_nombre,
                    'turno'=>$v->turno,
                    'grupo'=>$v->grupo,
                    'clasemarcacion'=>$v->clasemarcacion,
                    'clasemarcacion_descripcion'=>$v->clasemarcacion_descripcion,
                    'modalidadmarcacion_id'=>$v->modalidadmarcacion_id,
                    'modalidad_marcacion'=>$v->modalidad_marcacion,
                    'd1'=>$v->d1,
                    'calendariolaboral1_id'=>$v->calendariolaboral1_id,
                    'd2'=>$v->d2,
                    'calendariolaboral2_id'=>$v->calendariolaboral2_id,
                    'd3'=>$v->d3,
                    'calendariolaboral3_id'=>$v->calendariolaboral3_id,
                    'd4'=>$v->d4,
                    'calendariolaboral4_id'=>$v->calendariolaboral4_id,
                    'd5'=>$v->d5,
                    'calendariolaboral5_id'=>$v->calendariolaboral5_id,
                    'd6'=>$v->d6,
                    'calendariolaboral6_id'=>$v->calendariolaboral6_id,
                    'd7'=>$v->d7,
                    'calendariolaboral7_id'=>$v->calendariolaboral7_id,
                    'd8'=>$v->d8,
                    'calendariolaboral8_id'=>$v->calendariolaboral8_id,
                    'd9'=>$v->d9,
                    'calendariolaboral9_id'=>$v->calendariolaboral9_id,
                    'd10'=>$v->d10,
                    'calendariolaboral10_id'=>$v->calendariolaboral10_id,
                    'd11'=>$v->d11,
                    'calendariolaboral11_id'=>$v->calendariolaboral11_id,
                    'd12'=>$v->d12,
                    'calendariolaboral12_id'=>$v->calendariolaboral12_id,
                    'd13'=>$v->d13,
                    'calendariolaboral13_id'=>$v->calendariolaboral13_id,
                    'd14'=>$v->d14,
                    'calendariolaboral14_id'=>$v->calendariolaboral14_id,
                    'd15'=>$v->d15,
                    'calendariolaboral15_id'=>$v->calendariolaboral15_id,
                    'd16'=>$v->d16,
                    'calendariolaboral16_id'=>$v->calendariolaboral16_id,
                    'd17'=>$v->d17,
                    'calendariolaboral17_id'=>$v->calendariolaboral17_id,
                    'd18'=>$v->d18,
                    'calendariolaboral18_id'=>$v->calendariolaboral18_id,
                    'd19'=>$v->d19,
                    'calendariolaboral19_id'=>$v->calendariolaboral19_id,
                    'd20'=>$v->d20,
                    'calendariolaboral20_id'=>$v->calendariolaboral20_id,
                    'd21'=>$v->d21,
                    'calendariolaboral21_id'=>$v->calendariolaboral21_id,
                    'd22'=>$v->d22,
                    'calendariolaboral22_id'=>$v->calendariolaboral22_id,
                    'd23'=>$v->d23,
                    'calendariolaboral23_id'=>$v->calendariolaboral23_id,
                    'd24'=>$v->d24,
                    'calendariolaboral24_id'=>$v->calendariolaboral24_id,
                    'd25'=>$v->d25,
                    'calendariolaboral25_id'=>$v->calendariolaboral25_id,
                    'd26'=>$v->d26,
                    'calendariolaboral26_id'=>$v->calendariolaboral26_id,
                    'd27'=>$v->d27,
                    'calendariolaboral27_id'=>$v->calendariolaboral27_id,
                    'd28'=>$v->d28,
                    'calendariolaboral28_id'=>$v->calendariolaboral28_id,
                    'd29'=>$v->d29,
                    'calendariolaboral29_id'=>$v->calendariolaboral29_id,
                    'd30'=>$v->d30,
                    'calendariolaboral30_id'=>$v->calendariolaboral30_id,
                    'd31'=>$v->d31,
                    'calendariolaboral31_id'=>$v->calendariolaboral31_id,
                    'ultimo_dia'=>$v->ultimo_dia,
                    'atrasos'=>$v->atrasos,
                    'faltas'=>$v->faltas,
                    'abandono'=>$v->abandono,
                    'omision'=>$v->omision,
                    'lsgh'=>$v->lsgh,
                    'compensacion'=>$v->compensacion,
                    'estado'=>$v->estado,
                    'estado_descripcion'=>$v->estado_descripcion,
                    'baja_logica'=>$v->baja_logica,
                    'agrupador'=>$v->agrupador,
                    'user_reg_id'=>$v->user_reg_id,
                    'fecha_reg'=>$v->fecha_reg,
                    'user_apr_id'=>$v->user_apr_id,
                    'fecha_apr'=>$v->fecha_apr,
                    'user_mod_id'=>$v->user_mod_id,
                    'fecha_mod'=>$v->fecha_mod,
                );
                #region Sector para almacenamiento de los totales
                if($v->modalidadmarcacion_id==3||$v->modalidadmarcacion_id==6){
                    $atrasos = $faltas = $abandono = $omision = $lsgh = $compensacion = 0;
                    if($v->atrasos!=''){
                        $atrasos=$v->atrasos;
                    }
                    if($v->faltas!=''){
                        $faltas=$v->faltas;
                    }
                    if($v->abandono!=''){
                        $abandono=$v->abandono;
                    }
                    if($v->omision!=''){
                        $omision=$v->omision;
                    }
                    if($v->lsgh!=''){
                        $lsgh=$v->lsgh;
                    }
                    if($v->compensacion!=''){
                        $compensacion=$v->compensacion;
                    }
                    $totalAtrasos += $atrasos;
                    $totalFaltas += $faltas;
                    $totalAbandono += $abandono;
                    $totalOmision += $omision;
                    $totalLsgh += $lsgh;
                    $totalCompensacion += $compensacion;

                    $arrTotales[$v->relaboral_id][$v->gestion][$v->mes]["id_relaboral"]=$v->relaboral_id;
                    $arrTotales[$v->relaboral_id][$v->gestion][$v->mes]["nombres"]=$v->nombres;
                    $arrTotales[$v->relaboral_id][$v->gestion][$v->mes]["ci"]=$v->ci;
                    $arrTotales[$v->relaboral_id][$v->gestion][$v->mes]["expd"]=$v->expd;
                    $arrTotales[$v->relaboral_id][$v->gestion][$v->mes]["gestion"]=$v->gestion;
                    $arrTotales[$v->relaboral_id][$v->gestion][$v->mes]["mes"]=$v->mes;
                    $arrTotales[$v->relaboral_id][$v->gestion][$v->mes]["mes_nombre"]=$v->mes_nombre;
                    $arrTotales[$v->relaboral_id][$v->gestion][$v->mes]["condicion"]=$v->condicion;
                    $arrTotales[$v->relaboral_id][$v->gestion][$v->mes]["gerencia_administrativa"]=$v->gerencia_administrativa;
                    $arrTotales[$v->relaboral_id][$v->gestion][$v->mes]["departamento_administrativo"]=$v->departamento_administrativo;
                    $arrTotales[$v->relaboral_id][$v->gestion][$v->mes]["area"]=$v->area;
                    $arrTotales[$v->relaboral_id][$v->gestion][$v->mes]["ubicacion"]=$v->ubicacion;
                    $arrTotales[$v->relaboral_id][$v->gestion][$v->mes]["cargo"]=$v->cargo;
                    $arrTotales[$v->relaboral_id][$v->gestion][$v->mes]["sueldo"]=$v->sueldo;
                    /*echo "<p>---------------------------------------------------------------------</p>";
                    echo "1) ".$atrasos.", 2) ".$faltas.", 3) ".$abandono.", 4) ".$omision.", 5) ".$lsgh.", 6) ".$compensacion;
                    echo "<p>---------------------------------------------------------------------</p>";*/
                    if(isset($arrTotales[$v->relaboral_id][$v->gestion][$v->mes]["atrasos"])&&$arrTotales[$v->relaboral_id][$v->gestion][$v->mes]["atrasos"]>0){
                        $arrTotales[$v->relaboral_id][$v->gestion][$v->mes]["atrasos"] = $arrTotales[$v->relaboral_id][$v->gestion][$v->mes]["atrasos"] + $atrasos;
                    }else{
                        $arrTotales[$v->relaboral_id][$v->gestion][$v->mes]["atrasos"] = $atrasos;
                    }
                    if(isset($arrTotales[$v->relaboral_id][$v->gestion][$v->mes]["faltas"])&&$arrTotales[$v->relaboral_id][$v->gestion][$v->mes]["faltas"]>0){
                        $arrTotales[$v->relaboral_id][$v->gestion][$v->mes]["faltas"] = $arrTotales[$v->relaboral_id][$v->gestion][$v->mes]["faltas"] + $faltas;
                    }else{
                        $arrTotales[$v->relaboral_id][$v->gestion][$v->mes]["faltas"] = $faltas;
                    }
                    if(isset($arrTotales[$v->relaboral_id][$v->gestion][$v->mes]["abandono"])&&$arrTotales[$v->relaboral_id][$v->gestion][$v->mes]["abandono"]>0){
                        $arrTotales[$v->relaboral_id][$v->gestion][$v->mes]["abandono"] = $arrTotales[$v->relaboral_id][$v->gestion][$v->mes]["abandono"] + $abandono;
                    }else{
                        $arrTotales[$v->relaboral_id][$v->gestion][$v->mes]["abandono"] = $abandono;
                    }
                    if(isset($arrTotales[$v->relaboral_id][$v->gestion][$v->mes]["omision"])&&$arrTotales[$v->relaboral_id][$v->gestion][$v->mes]["omision"]>0){
                        $arrTotales[$v->relaboral_id][$v->gestion][$v->mes]["omision"] = $arrTotales[$v->relaboral_id][$v->gestion][$v->mes]["omision"] + $omision;
                    }else{
                        $arrTotales[$v->relaboral_id][$v->gestion][$v->mes]["omision"] = $omision;
                    }
                    if(isset($arrTotales[$v->relaboral_id][$v->gestion][$v->mes]["lsgh"])&&$arrTotales[$v->relaboral_id][$v->gestion][$v->mes]["lsgh"]>0){
                        $arrTotales[$v->relaboral_id][$v->gestion][$v->mes]["lsgh"] = $arrTotales[$v->relaboral_id][$v->gestion][$v->mes]["lsgh"] + $lsgh;
                    }else{
                        $arrTotales[$v->relaboral_id][$v->gestion][$v->mes]["lsgh"] = $lsgh;
                    }
                    if(isset($arrTotales[$v->relaboral_id][$v->gestion][$v->mes]["compensacion"])&&$arrTotales[$v->relaboral_id][$v->gestion][$v->mes]["compensacion"]>0){
                        $arrTotales[$v->relaboral_id][$v->gestion][$v->mes]["compensacion"] = $arrTotales[$v->relaboral_id][$v->gestion][$v->mes]["compensacion"] + $compensacion;
                    }else{
                        $arrTotales[$v->relaboral_id][$v->gestion][$v->mes]["compensacion"] = $compensacion;
                    }
                }
                #endregion Sector para almacenamiento de los totales
                #region Sector para adicionar una fila para Excepciones
                if($v->modalidadmarcacion_id==6){
                    $d1=$d2=$d3=$d4=$d5=$d6=$d7=$d8=$d9=$d10=$d11=$d12=$d13=$d14=$d15=$d16=$d17=$d18=$d19=$d20=$d21=$d22=$d23=$d24=$d25=$d26=$d27=$d28=$d29=$d30=$d30=$d31="";
                    if($v->calendariolaboral1_id>0){
                        $res1 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,1,$v->calendariolaboral1_id);
                        if(is_object($res1)&&$res1->count()>0){
                            foreach($res1 as $r1){
                                $d1 = $r1->f_excepciones_en_dia;
                            }
                        }
                    }
                    if($v->calendariolaboral2_id>0){
                        $res2 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,2,$v->calendariolaboral2_id,1);
                        if(is_object($res2)&&$res2->count()>0){
                            foreach($res2 as $r2){
                                $d2 = $r2->f_excepciones_en_dia;
                            }
                        }
                    }
                    if($v->calendariolaboral3_id>0){
                        $res3 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,3,$v->calendariolaboral3_id,1);
                        if(is_object($res3)&&$res3->count()>0){
                            foreach($res3 as $r3){
                                $d3 = $r3->f_excepciones_en_dia;
                            }
                        }
                    }

                    if($v->calendariolaboral4_id>0){
                        $res4 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,4,$v->calendariolaboral4_id,1);
                        if(is_object($res4)&&$res4->count()>0){
                            foreach($res4 as $r4){
                                $d4 = $r4->f_excepciones_en_dia;
                            }
                        }
                    }
                    if($v->calendariolaboral5_id>0){
                        $res5 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,5,$v->calendariolaboral5_id,1);
                        if(is_object($res5)&&$res5->count()>0){
                            foreach($res5 as $r5){
                                $d5 = $r5->f_excepciones_en_dia;
                            }
                        }
                    }
                    if($v->calendariolaboral6_id>0){
                        $res6 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,6,$v->calendariolaboral6_id,1);
                        if(is_object($res6)&&$res6->count()>0){
                            foreach($res6 as $r6){
                                $d6 = $r6->f_excepciones_en_dia;
                            }
                        }
                    }
                    if($v->calendariolaboral7_id>0){
                        $res7 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,7,$v->calendariolaboral7_id,1);
                        if(is_object($res7)&&$res7->count()>0){
                            foreach($res7 as $r7){
                                $d7 = $r7->f_excepciones_en_dia;
                            }
                        }
                    }
                    if($v->calendariolaboral8_id>0){
                        $res8 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,8,$v->calendariolaboral8_id,1);
                        if(is_object($res8)&&$res8->count()>0){
                            foreach($res8 as $r8){
                                $d8 = $r8->f_excepciones_en_dia;
                            }
                        }
                    }
                    if($v->calendariolaboral9_id>0){
                        $res9 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,9,$v->calendariolaboral9_id,1);
                        if(is_object($res9)&&$res9->count()>0){
                            foreach($res9 as $r9){
                                $d9 = $r9->f_excepciones_en_dia;
                            }
                        }
                    }
                    if($v->calendariolaboral10_id>0){
                        $res10 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,10,$v->calendariolaboral10_id,1);
                        if(is_object($res10)&&$res10->count()>0){
                            foreach($res10 as $r10){
                                $d10 = $r10->f_excepciones_en_dia;
                            }
                        }
                    }
                    if($v->calendariolaboral11_id>0){
                        $res11 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,11,$v->calendariolaboral11_id,1);
                        if(is_object($res11)&&$res11->count()>0){
                            foreach($res11 as $r11){
                                $d11 = $r11->f_excepciones_en_dia;
                            }
                        }
                    }
                    if($v->calendariolaboral12_id>0){
                        $res12 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,12,$v->calendariolaboral12_id,1);
                        if(is_object($res12)&&$res12->count()>0){
                            foreach($res12 as $r12){
                                $d12 = $r12->f_excepciones_en_dia;
                            }
                        }
                    }

                    if($v->calendariolaboral13_id>0){
                        $res13 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,13,$v->calendariolaboral13_id,1);
                        if(is_object($res13)&&$res13->count()>0){
                            foreach($res13 as $r13){
                                $d13 = $r13->f_excepciones_en_dia;
                            }
                        }
                    }

                    if($v->calendariolaboral14_id>0){
                        $res14 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,14,$v->calendariolaboral14_id,1);
                        if(is_object($res14)&&$res14->count()>0){
                            foreach($res14 as $r14){
                                $d14 = $r14->f_excepciones_en_dia;
                            }
                        }
                    }
                    if($v->calendariolaboral15_id>0){
                        $res15 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,15,$v->calendariolaboral15_id,1);
                        if(is_object($res15)&&$res15->count()>0){
                            foreach($res15 as $r15){
                                $d15 = $r15->f_excepciones_en_dia;
                            }
                        }
                    }
                    if($v->calendariolaboral16_id>0){
                        $res16 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,16,$v->calendariolaboral16_id,1);
                        if(is_object($res16)&&$res16->count()>0){
                            foreach($res16 as $r16){
                                $d16 = $r16->f_excepciones_en_dia;
                            }
                        }
                    }
                    if($v->calendariolaboral17_id>0){
                        $res17 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,17,$v->calendariolaboral17_id,1);
                        if(is_object($res17)&&$res17->count()>0){
                            foreach($res17 as $r17){
                                $d17 = $r17->f_excepciones_en_dia;
                            }
                        }
                    }
                    if($v->calendariolaboral18_id>0){
                        $res18 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,18,$v->calendariolaboral18_id,1);
                        if(is_object($res18)&&$res18->count()>0){
                            foreach($res18 as $r){
                                $d18 = $r->f_excepciones_en_dia;
                            }
                        }
                    }
                    if($v->calendariolaboral19_id>0){
                        $res19 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,19,$v->calendariolaboral19_id,1);
                        if(is_object($res19)&&$res19->count()>0){
                            foreach($res19 as $r){
                                $d19 = $r->f_excepciones_en_dia;
                            }
                        }
                    }
                    if($v->calendariolaboral20_id>0){
                        $res20 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,20,$v->calendariolaboral20_id,1);
                        if(is_object($res20)&&$res20->count()>0){
                            foreach($res20 as $r){
                                $d20 = $r->f_excepciones_en_dia;
                            }
                        }
                    }
                    if($v->calendariolaboral21_id>0){
                        $res21 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,21,$v->calendariolaboral21_id,1);
                        if(is_object($res21)&&$res21->count()>0){
                            foreach($res21 as $r21){
                                $d21 = $r21->f_excepciones_en_dia;
                            }
                        }
                    }
                    if($v->calendariolaboral22_id>0){
                        $res22 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,22,$v->calendariolaboral22_id,1);
                        if(is_object($res22)&&$res22->count()>0){
                            foreach($res22 as $r22){
                                $d22 = $r22->f_excepciones_en_dia;
                            }
                        }
                    }
                    if($v->calendariolaboral23_id>0){
                        $res23 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,23,$v->calendariolaboral23_id,1);
                        if(is_object($res23)&&$res23->count()>0){
                            foreach($res23 as $r23){
                                $d23 = $r23->f_excepciones_en_dia;
                            }
                        }
                    }
                    if($v->calendariolaboral24_id>0){
                        $res24 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,24,$v->calendariolaboral24_id,1);
                        if(is_object($res24)&&$res24->count()>0){
                            foreach($res24 as $r24){
                                $d24 = $r24->f_excepciones_en_dia;
                            }
                        }
                    }
                    if($v->calendariolaboral25_id>0){
                        $res25 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,25,$v->calendariolaboral25_id,1);
                        if(is_object($res25)&&$res25->count()>0){
                            foreach($res25 as $r25){
                                $d25 = $r25->f_excepciones_en_dia;
                            }
                        }
                    }
                    if($v->calendariolaboral26_id>0){
                        $res26 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,26,$v->calendariolaboral26_id,1);
                        if(is_object($res26)&&$res26->count()>0){
                            foreach($res26 as $r26){
                                $d26 = $r26->f_excepciones_en_dia;
                            }
                        }
                    }
                    if($v->calendariolaboral27_id>0){
                        $res27 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,27,$v->calendariolaboral27_id,1);
                        if(is_object($res27)&&$res27->count()>0){
                            foreach($res27 as $r27){
                                $d27 = $r27->f_excepciones_en_dia;
                            }

                        }
                    }
                    if($v->calendariolaboral28_id>0){
                        $res28 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,28,$v->calendariolaboral28_id,1);
                        if(is_object($res28)&&$res28->count()>0){
                            foreach($res28 as $r28){
                                $d28 = $r28->f_excepciones_en_dia;
                            }
                        }
                    }
                    if($v->calendariolaboral29_id>0){
                        $res29 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,29,$v->calendariolaboral29_id,1);
                        if(is_object($res29)&&$res29->count()>0){
                            foreach($res29 as $r29){
                                $d29 = $r29->f_excepciones_en_dia;
                            }
                        }
                    }
                    if($v->calendariolaboral30_id>0){
                        $res30 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,30,$v->calendariolaboral30_id,1);
                        if(is_object($res30)&&$res30->count()>0){
                            foreach($res30 as $r30){
                                $d30 = $r30->f_excepciones_en_dia;
                            }

                        }
                    }
                    if($v->calendariolaboral31_id>0){
                        $res31 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,31,$v->calendariolaboral31_id,1);
                        if(is_object($res31)&&$res31->count()>0){
                            foreach($res31 as $r31){
                                $d31 = $r31->f_excepciones_en_dia;
                            }
                        }
                    }
                    $horariosymarcaciones[] = array(
                        #region Columnas de procedimiento f_relaborales()
                        'id_relaboral' => $v->id_relaboral,
                        'id_persona' => $v->id_persona,
                        'p_nombre' => $v->p_nombre,
                        's_nombre' => $v->s_nombre,
                        't_nombre' => $v->t_nombre,
                        'p_apellido' => $v->p_apellido,
                        's_apellido' => $v->s_apellido,
                        'c_apellido' => $v->c_apellido,
                        'nombres' => $v->nombres,
                        'ci' => $v->ci,
                        'expd' => $v->expd,
                        'cargo' => $v->cargo,
                        'sueldo' => str_replace(".00", "", $v->sueldo),
                        'condicion' => $v->condicion,
                        'gerencia_administrativa' => $v->gerencia_administrativa,
                        'departamento_administrativo' => $v->departamento_administrativo,
                        'area' => $v->area,
                        'ubicacion' => $v->ubicacion,
                        #endregion Columnas de procedimiento f_relaborales()

                        'id'=>$v->id_horarioymarcacion,
                        'relaboral_id'=>$v->relaboral_id,
                        'gestion'=>$v->gestion,
                        'mes'=>$v->mes,
                        'mes_nombre'=>$v->mes_nombre,
                        'turno'=>$v->turno,
                        'grupo'=>$v->grupo,
                        'clasemarcacion'=>"e",
                        'clasemarcacion_descripcion'=>"EXCEPCIONES",
                        'modalidadmarcacion_id'=>$v->modalidadmarcacion_id,
                        'modalidad_marcacion'=>"EXCEPCIONES",
                        'd1'=>$d1,
                        'calendariolaboral1_id'=>$v->calendariolaboral1_id,
                        'd2'=>$d2,
                        'calendariolaboral2_id'=>$v->calendariolaboral2_id,
                        'd3'=>$d3,
                        'calendariolaboral3_id'=>$v->calendariolaboral3_id,
                        'd4'=>$d4,
                        'calendariolaboral4_id'=>$v->calendariolaboral4_id,
                        'd5'=>$d5,
                        'calendariolaboral5_id'=>$v->calendariolaboral5_id,
                        'd6'=>$d6,
                        'calendariolaboral6_id'=>$v->calendariolaboral6_id,
                        'd7'=>$d7,
                        'calendariolaboral7_id'=>$v->calendariolaboral7_id,
                        'd8'=>$d8,
                        'calendariolaboral8_id'=>$v->calendariolaboral8_id,
                        'd9'=>$d9,
                        'calendariolaboral9_id'=>$v->calendariolaboral9_id,
                        'd10'=>$d10,
                        'calendariolaboral10_id'=>$v->calendariolaboral10_id,
                        'd11'=>$d11,
                        'calendariolaboral11_id'=>$v->calendariolaboral11_id,
                        'd12'=>$d12,
                        'calendariolaboral12_id'=>$v->calendariolaboral12_id,
                        'd13'=>$d13,
                        'calendariolaboral13_id'=>$v->calendariolaboral13_id,
                        'd14'=>$d14,
                        'calendariolaboral14_id'=>$v->calendariolaboral14_id,
                        'd15'=>$d15,
                        'calendariolaboral15_id'=>$v->calendariolaboral15_id,
                        'd16'=>$d16,
                        'calendariolaboral16_id'=>$v->calendariolaboral16_id,
                        'd17'=>$d17,
                        'calendariolaboral17_id'=>$v->calendariolaboral17_id,
                        'd18'=>$d18,
                        'calendariolaboral18_id'=>$v->calendariolaboral18_id,
                        'd19'=>$d19,
                        'calendariolaboral19_id'=>$v->calendariolaboral19_id,
                        'd20'=>$d20,
                        'calendariolaboral20_id'=>$v->calendariolaboral20_id,
                        'd21'=>$d21,
                        'calendariolaboral21_id'=>$v->calendariolaboral21_id,
                        'd22'=>$d22,
                        'calendariolaboral22_id'=>$v->calendariolaboral22_id,
                        'd23'=>$d23,
                        'calendariolaboral23_id'=>$v->calendariolaboral23_id,
                        'd24'=>$d24,
                        'calendariolaboral24_id'=>$v->calendariolaboral24_id,
                        'd25'=>$d25,
                        'calendariolaboral25_id'=>$v->calendariolaboral25_id,
                        'd26'=>$d26,
                        'calendariolaboral26_id'=>$v->calendariolaboral26_id,
                        'd27'=>$d27,
                        'calendariolaboral27_id'=>$v->calendariolaboral27_id,
                        'd28'=>$d28,
                        'calendariolaboral28_id'=>$v->calendariolaboral28_id,
                        'd29'=>$d29,
                        'calendariolaboral29_id'=>$v->calendariolaboral29_id,
                        'd30'=>$d30,
                        'calendariolaboral30_id'=>$v->calendariolaboral30_id,
                        'd31'=>$d31,
                        'calendariolaboral31_id'=>$v->calendariolaboral31_id,
                        'ultimo_dia'=>$v->ultimo_dia,
                        'atrasos'=>null,
                        'faltas'=>null,
                        'abandono'=>null,
                        'omision'=>null,
                        'lsgh'=>null,
                        'compensacion'=>null,
                        'observacion'=>$v->observacion,
                        'estado'=>$v->estado,
                        'estado_descripcion'=>$v->estado_descripcion,
                        'baja_logica'=>$v->baja_logica,
                        'agrupador'=>$v->agrupador,
                        'user_reg_id'=>$v->user_reg_id,
                        'fecha_reg'=>$v->fecha_reg,
                        'user_apr_id'=>$v->user_apr_id,
                        'fecha_apr'=>$v->fecha_apr,
                        'user_mod_id'=>$v->user_mod_id,
                        'fecha_mod'=>$v->fecha_mod,
                    );
                }
                #endregion sector para adicionar una fila para Excepciones
            }
            #region Espacio para la definición de valores para la cabecera de la tabla
            $excel->FechaHoraReporte = date("d-m-Y H:i:s");
            $j = 0;
            $agrupadores = array();
            if ($groups != "")
                $agrupadores = explode(",", $groups);

            $dondeCambio = array();
            $queCambio = array();
            $excel->header();
            $fila=$excel->numFilaCabeceraTabla;
            if (count($horariosymarcaciones) > 0){
                $excel->RowTitle($colTitleSelecteds,$fila);
                $celdaInicial=$excel->primeraLetraCabeceraTabla.$fila;
                $celdaFinalDiagonalTabla=$excel->ultimaLetraCabeceraTabla.$fila;
                if ($excel->debug == 1) {
                    echo "<p>|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||<p></p>";
                    print_r($horariosymarcaciones);
                    echo "<p>|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||<p></p>";
                }
                foreach ($horariosymarcaciones as $i => $val) {
                    if (count($agrupadores) > 0) {
                        if ($excel->debug == 1) {
                            echo "<p>|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||<p></p>";
                            print_r($gruposSeleccionadosActuales);
                            echo "<p>|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||<p></p>";
                        }
                        $agregarAgrupador = 0;
                        $aux = array();
                        $dondeCambio = array();
                        foreach ($gruposSeleccionadosActuales as $key => $valor) {
                            if ($valor != $val[$key]) {
                                $agregarAgrupador = 1;
                                $aux[$key] = $val[$key];
                                $dondeCambio[] = $key;
                                $queCambio[$key] = $val[$key];
                            } else {
                                $aux[$key] = $val[$key];
                            }
                        }
                        $gruposSeleccionadosActuales = $aux;
                        if ($agregarAgrupador == 1) {
                            $agr = $excel->DefineTitleColsByGroups($generalConfigForAllColumns, $dondeCambio, $queCambio);
                            if($excel->debug==1){
                                echo "<p>+++++++++++++++++++++++++++AGRUPADO POR++++++++++++++++++++++++++++++++++++++++<p></p>";
                                print_r($agr);
                                echo "<p>+++++++++++++++++++++++++++AGRUPADO POR++++++++++++++++++++++++++++++++++++++++<p></p>";
                            }
                            $excel->borderGroup($celdaInicial,$celdaFinalDiagonalTabla);
                            $fila++;
                            /*
                             * Si es que hay agrupadores, se inicia el conteo desde donde empieza el agrupador
                             */
                            $celdaInicial=$excel->primeraLetraCabeceraTabla.$fila;
                            $excel->Agrupador($agr,$fila);
                            $excel->RowTitle($colTitleSelecteds,$fila);
                        }
                        $celdaFinalDiagonalTabla=$excel->ultimaLetraCabeceraTabla.$fila;
                        $rowData = $excel->DefineRows($j + 1, $horariosymarcaciones[$j], $colSelecteds);
                        if ($excel->debug == 1) {
                            echo "<p>···································FILA·················································<p></p>";
                            print_r($rowData);
                            echo "<p>···································FILA·················································<p></p>";
                        }
                        $excel->Row($rowData,$alignSelecteds,$formatTypes,$fila);
                        $fila++;

                    } else {
                        $celdaFinalDiagonalTabla=$excel->ultimaLetraCabeceraTabla.$fila;
                        $rowData = $excel->DefineRows($j + 1, $val, $colSelecteds);
                        if ($excel->debug == 1) {
                            echo "<p>···································FILA·················································<p></p>";
                            print_r($rowData);
                            echo "<p>···································FILA·················································<p></p>";
                        }
                        $celdacolores = array();
                        if($rowData[0]%7 == 0){
                            if($excel->debug==1){
                                echo "<p>xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx</p>";
                            }
                            for($i=1;$i<=31;$i++){
                                if(in_array("d".$i,$colSelecteds)){
                                    $clave = array_search("d".$i,$colSelecteds);
                                    if(isset($rowData[$clave])&&$rowData[$clave]!=''){
                                        $celdacolores[$clave] = "FF00FF00";
                                    }
                                }
                            }
                            if($excel->debug==1){
                                print_r($celdacolores);
                                echo "<p>xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx</p>";
                            }
                        }
                        $excel->Row($rowData,$alignSelecteds,$formatTypes,$fila,$celdacolores);
                        $fila++;
                    }
                    $j++;
                }
                $fila--;
                $celdaFinalDiagonalTabla=$excel->ultimaLetraCabeceraTabla.$fila;
                $excel->borderGroup($celdaInicial,$celdaFinalDiagonalTabla);
                $totalColSelecteds = $excel->DefineSelectedTotalCols($generalConfigForAllColumns);
                $totalTitleColSelecteds = $excel->DefineTotalTitleCols($generalConfigForAllColumns,$totalColSelecteds);

                if($excel->debug==1){
                    echo "<P>*****************************************TOTALES*****************************************</P>";
                    print_r($arrTotales);
                    echo "<P>*****************************************COLUMNAS SELECCIONADAS*****************************************</P>";
                    print_r($totalColSelecteds);
                    echo "<P>*****************************************TITULOS DE COLUMNAS SELECCIONADAS*****************************************</P>";
                    print_r($totalTitleColSelecteds);
                    echo "<P>**********************************************************************************</P>";
                }else{
                    $excel->agregarPaginaTotales($arrTotales,$totalColSelecteds,$totalTitleColSelecteds,$totalAtrasos,$totalFaltas,$totalAbandono,$totalOmision,$totalLsgh,$totalCompensacion);
                }
            }
            $excel->ShowLeftFooter = true;
            //$excel->secondPage();
            if ($excel->debug == 0) {
                $excel->display("AppData/reporte_marcaciones.xls","I");
            }
            #endregion Proceso de generación del documento PDF
        }
    }

    /**
     * Función para el despliegue del reporte de marcaciones en formato PDF.
     * @param $idRelaboral
     * @param $n_rows
     * @param $columns
     * @param $filtros
     * @param $groups
     * @param $sorteds
     */
    public function exportmarcacionespdfAction($idRelaboral,$n_rows, $columns, $filtros,$groups,$sorteds)
    {   $columns = base64_decode(str_pad(strtr($columns, '-_', '+/'), strlen($columns) % 4, '=', STR_PAD_RIGHT));
        $filtros = base64_decode(str_pad(strtr($filtros, '-_', '+/'), strlen($columns) % 4, '=', STR_PAD_RIGHT));
        $groups = base64_decode(str_pad(strtr($groups, '-_', '+/'), strlen($groups) % 4, '=', STR_PAD_RIGHT));
        if($groups=='null'||$groups==null)$groups="";
        $sorteds = base64_decode(str_pad(strtr($sorteds, '-_', '+/'), strlen($sorteds) % 4, '=', STR_PAD_RIGHT));
        $columns = json_decode($columns, true);
        $filtros = json_decode($filtros, true);
        $sub_keys = array_keys($columns);//echo $sub_keys[0];
        $n_col = count($columns);//echo$keys[1];
        $sorteds = json_decode($sorteds, true);
        /**
         * Especificando la configuración de las columnas
         */
        $generalConfigForAllColumns = array(
            'nro_row' => array('title' => 'Nro.', 'width' => 8, 'title-align'=>'C','align' => 'C', 'type' => 'int4'),
            'estado_descripcion' => array('title' => 'Estado', 'width' => 15, 'align' => 'C', 'type' => 'varchar'),
            'gestion' => array('title' => 'Gestion', 'width' => 20, 'align' => 'C', 'type' => 'numeric'),
            'mes_nombre' => array('title' => 'Mes', 'width' => 20, 'align' => 'C', 'type' => 'varchar'),
            'turno' => array('title' => 'Turno', 'width' => 10, 'align' => 'C', 'type' => 'numeric'),
            'modalidad_marcacion' => array('title' => 'Modalidad', 'width' => 30, 'align' => 'C', 'type' => 'varchar'),
            'd1' => array('title' => 'Dia 1', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado1_descripcion' => array('title' => 'Estado Dia 1', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd2' => array('title' => 'Dia 2', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado2_descripcion' => array('title' => 'Estado Dia 2', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd3' => array('title' => 'Dia 3', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado3_descripcion' => array('title' => 'Estado Dia 3', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd4' => array('title' => 'Dia 4', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado4_descripcion' => array('title' => 'Estado Dia 4', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd5' => array('title' => 'Dia 5', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado5_descripcion' => array('title' => 'Estado Dia 5', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd6' => array('title' => 'Dia 6', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado6_descripcion' => array('title' => 'Estado Dia 6', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd7' => array('title' => 'Dia 7', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado7_descripcion' => array('title' => 'Estado Dia 7', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd8' => array('title' => 'Dia 8', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado8_descripcion' => array('title' => 'Estado Dia 8', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd9' => array('title' => 'Dia 9', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado9_descripcion' => array('title' => 'Estado Dia 9', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd10' => array('title' => 'Dia 10', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado10_descripcion' => array('title' => 'Estado Dia 10', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd11' => array('title' => 'Dia 11', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado11_descripcion' => array('title' => 'Estado Dia 11', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd12' => array('title' => 'Dia 12', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado12_descripcion' => array('title' => 'Estado Dia 12', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd13' => array('title' => 'Dia 13', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado13_descripcion' => array('title' => 'Estado Dia 13', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd14' => array('title' => 'Dia 14', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado14_descripcion' => array('title' => 'Estado Dia 14', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd15' => array('title' => 'Dia 15', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado15_descripcion' => array('title' => 'Estado Dia 15', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd16' => array('title' => 'Dia 16', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado16_descripcion' => array('title' => 'Estado Dia 16', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd17' => array('title' => 'Dia 17', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado17_descripcion' => array('title' => 'Estado Dia 17', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd18' => array('title' => 'Dia 18', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado18_descripcion' => array('title' => 'Estado Dia 18', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd19' => array('title' => 'Dia 19', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado19_descripcion' => array('title' => 'Estado Dia 19', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd20' => array('title' => 'Dia 20', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado20_descripcion' => array('title' => 'Estado Dia 20', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd21' => array('title' => 'Dia 21', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado21_descripcion' => array('title' => 'Estado Dia 21', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd22' => array('title' => 'Dia 22', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado22_descripcion' => array('title' => 'Estado Dia 22', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd23' => array('title' => 'Dia 23', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado23_descripcion' => array('title' => 'Estado Dia 23', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd24' => array('title' => 'Dia 24', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado24_descripcion' => array('title' => 'Estado Dia 24', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd25' => array('title' => 'Dia 25', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado25_descripcion' => array('title' => 'Estado Dia 25', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd26' => array('title' => 'Dia 26', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado26_descripcion' => array('title' => 'Estado Dia 26', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd27' => array('title' => 'Dia 27', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado27_descripcion' => array('title' => 'Estado Dia 27', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd28' => array('title' => 'Dia 28', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado28_descripcion' => array('title' => 'Estado Dia 28', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd29' => array('title' => 'Dia 29', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado29_descripcion' => array('title' => 'Estado Dia 29', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd30' => array('title' => 'Dia 30', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado30_descripcion' => array('title' => 'Estado Dia 30', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd31' => array('title' => 'Dia 31', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado31_descripcion' => array('title' => 'Estado Dia 31', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'ultimo_dia' => array('title' => 'U/Dia', 'width' => 10, 'align' => 'C', 'type' => 'numeric'),
            'atrasos' => array('title' => 'Atrasos', 'width' => 20, 'align' => 'C', 'type' => 'numeric'),
            'faltas' => array('title' => 'Faltas', 'width' => 20, 'align' => 'C', 'type' => 'numeric'),
            'abandono' => array('title' => 'Abandono', 'width' => 20, 'align' => 'C', 'type' => 'numeric'),
            'omision' => array('title' => 'Omision', 'width' => 20, 'align' => 'C', 'type' => 'numeric'),
            'lsgh' => array('title' => 'LSGH', 'width' => 20, 'align' => 'C', 'type' => 'numeric'),
            'observacion' => array('title' => 'Obs.', 'width' => 30, 'align' => 'L', 'type' => 'varchar')
        );
        $agruparPor = ($groups!="")?explode(",",$groups):array();
        $widthsSelecteds = $this->DefineWidths($generalConfigForAllColumns, $columns,$agruparPor);
        $ancho = 0;
        if(count($widthsSelecteds)>0) {
            foreach ($widthsSelecteds as $w) {
                $ancho = $ancho + $w;
            }
            if ($ancho > 215.9) {
                if ($ancho > 270) {
                    $pdf = new pdfoasis('L', 'mm', 'Legal');
                    $pdf->pageWidth = 355;
                } else {
                    $pdf = new pdfoasis('L', 'mm', 'Letter');
                    $pdf->pageWidth = 280;
                }
            } else {
                $pdf = new pdfoasis('P', 'mm', 'Letter');
                $pdf->pageWidth = 215.9;
            }
            $pdf->tableWidth = $ancho;
            #region Proceso de generación del documento PDF
            $pdf->debug =0;
            $pdf->title_rpt = utf8_decode('Reporte Marcaciones');
            $pdf->header_title_empresa_rpt = utf8_decode('Empresa Estatal de Transporte por Cable "Mi Teleférico"');
            $alignSelecteds = $pdf->DefineAligns($generalConfigForAllColumns, $columns, $agruparPor);
            $colSelecteds = $pdf->DefineCols($generalConfigForAllColumns, $columns, $agruparPor);
            if ($pdf->debug == 1) {
                echo "<p>^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^COLUMNAS A MOSTRARSE^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^(".count($colSelecteds).")</p>";
                print_r($colSelecteds);
                echo "<p>^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^";
            }
            $colTitleSelecteds = $pdf->DefineTitleCols($generalConfigForAllColumns, $columns, $agruparPor);
            $alignTitleSelecteds = $pdf->DefineTitleAligns(count($colTitleSelecteds));
            $gruposSeleccionadosActuales = $pdf->DefineDefaultValuesForGroups($groups);
            $pdf->generalConfigForAllColumns = $generalConfigForAllColumns;
            $pdf->colTitleSelecteds = $colTitleSelecteds;
            $pdf->widthsSelecteds = $widthsSelecteds;
            $pdf->alignSelecteds = $alignSelecteds;
            $pdf->alignTitleSelecteds = $alignTitleSelecteds;
            if ($pdf->debug == 1) {
                echo "<p>^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^idRelaboral^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^";
                echo "<p>".$idRelaboral;
                echo "<p>^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^";
                echo "<p>::::::::::::::::::::::::::::::::::::::::::::TOTAL COLUMNAS::::::::::::::::::::::::::::::::::::::::::(".count($columns).")<p>";
                print_r($columns);
                echo "<p>::::::::::::::::::::::::::::::::::::::::::::FILTROS::::::::::::::::::::::::::::::::::::::::::(".count($filtros).")<p>";
                print_r($filtros);
                echo "<p>::::::::::::::::::::::::::::::::::::::::::::GRUPOS::::::::::::::::::::::::::::::::::::::::::::<p>";
                echo "<p>" . $groups;
                echo "<p>::::::::::::::::::::::::::::::::::::::::::::ORDEN::::::::::::::::::::::::::::::::::::::::::::<p>";
                print_r($sorteds);
                echo "<p>:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::<p>";
            }
            $where = '';
            $yaConsiderados = array();
            for ($k = 0; $k < count($filtros); $k++) {
                $cant = $this->obtieneCantidadVecesConsideracionPorColumnaEnFiltros($filtros[$k]['columna'], $filtros);
                $arr_val = $this->obtieneValoresConsideradosPorColumnaEnFiltros($filtros[$k]['columna'], $filtros);

                for ($j = 0; $j < $n_col; $j++) {
                    if ($sub_keys[$j] == $filtros[$k]['columna']) {
                        $col_fil = $columns[$sub_keys[$j]]['text'];
                    }
                }
                if ($filtros[$k]['tipo'] == 'datefilter') {
                    $filtros[$k]['valor'] = date("Y-m-d", strtotime($filtros[$k]['valor']));
                }
                $cond_fil = ' ' . $col_fil;
                if (!in_array($filtros[$k]['columna'], $yaConsiderados)) {

                    if (strlen($where) > 0) {
                        switch ($filtros[$k]['condicion']) {
                            case 'EMPTY':
                                $where .= ' AND ';
                                break;
                            case 'NOT_EMPTY':
                                $where .= ' AND ';
                                break;
                            case 'CONTAINS':
                                $where .= ' AND ';
                                break;
                            case 'EQUAL':
                                $where .= ' AND ';
                                break;
                            case 'GREATER_THAN_OR_EQUAL':
                                $where .= ' AND ';
                                break;
                            case 'LESS_THAN_OR_EQUAL':
                                $where .= ' AND ';
                                break;
                        }
                    }
                }
                if ($cant > 1) {
                    if ($pdf->debug == 1) {
                        echo "<p>::::::::::::::::::::::::::::::::::::YA CONSIDERADOS:::::::::::::::::::::::::::::::::::::::::::::::<p>";
                        print_r($yaConsiderados);
                        echo "<p>::::::::::::::::::::::::::::::::::::YA CONSIDERADOS:::::::::::::::::::::::::::::::::::::::::::::::<p>";
                    }
                    if (!in_array($filtros[$k]['columna'], $yaConsiderados)) {
                        switch ($filtros[$k]['condicion']) {
                            case 'EMPTY':
                                $cond_fil .= utf8_encode(" que sea vacía ");
                                $where .= "(" . $filtros[$k]['columna'] . " IS NULL OR " . $filtros[$k]['columna'] . " ILIKE '')";
                                break;
                            case 'NOT_EMPTY':
                                $cond_fil .= utf8_encode(" que no sea vacía ");
                                $where .= "(" . $filtros[$k]['columna'] . " IS NOT NULL OR " . $filtros[$k]['columna'] . " NOT ILIKE '')";
                                break;
                            case 'CONTAINS':
                                $cond_fil .= utf8_encode(" que contenga el valor:  " . $filtros[$k]['valor']);
                                $where .= $filtros[$k]['columna'] . " ILIKE '%" . $filtros[$k]['valor'] . "%'";
                                break;
                            case 'EQUAL':
                                $cond_fil .= utf8_encode(" que contenga el valor:  " . $filtros[$k]['valor']);
                                $ini = 0;
                                foreach ($arr_val as $col) {
                                    if ($pdf->debug == 1) {

                                        echo "<p>.........................recorriendo las columnas multiseleccionadas: .............................................";
                                        echo $filtros[$k]['columna'] . "-->" . $col;
                                        echo "<p>.........................recorriendo las columnas multiseleccionadas: .............................................";
                                    }
                                    if (isset($generalConfigForAllColumns[$filtros[$k]['columna']]['type'])) {
                                        //$where .= $filtros[$k]['columna']." ILIKE '".$filtros[$k]['valor']."'";
                                        if ($ini == 0) {
                                            $where .= " (";
                                        }
                                        switch (@$generalConfigForAllColumns[$filtros[$k]['columna']]['type']) {
                                            case 'int4':
                                            case 'numeric':
                                            case 'date':
                                                //$whereEqueals .= $filtros[$k]['columna']." = '".$filtros[$k]['valor']."'";
                                                $where .= $filtros[$k]['columna'] . " = '" . $col . "'";
                                                break;
                                            case 'varchar':
                                            case 'bpchar':
                                                //$whereEqueals .= $filtros[$k]['columna']." ILIKE '".$filtros[$k]['valor']."'";
                                                $where .= $filtros[$k]['columna'] . " ILIKE '" . $col . "'";
                                                break;
                                        }
                                        $ini++;
                                        if ($ini == count($arr_val)) {
                                            $where .= ") ";
                                        } else $where .= " OR ";
                                    }
                                }
                                break;
                            case 'GREATER_THAN_OR_EQUAL':
                                $cond_fil .= utf8_encode(" que sea mayor o igual que:  " . $filtros[$k]['valor']);
                                $ini = 0;
                                foreach ($arr_val as $col) {
                                    //$fecha = date("Y-m-d", $col);
                                    $fecha = $col;
                                    if (isset($generalConfigForAllColumns[$filtros[$k]['columna']]['type'])) {
                                        //$where .= $filtros[$k]['columna']." ILIKE '".$filtros[$k]['valor']."'";
                                        if ($ini == 0) {
                                            $where .= " (";
                                        }
                                        switch (@$generalConfigForAllColumns[$filtros[$k]['columna']]['type']) {
                                            case 'int4':
                                            case 'numeric':
                                                $where .= $filtros[$k]['columna'] . " = '" . $fecha . "'";
                                                break;
                                            case 'date':
                                                //$whereEqueals .= $filtros[$k]['columna']." = '".$filtros[$k]['valor']."'";
                                                if ($ini == 0) {
                                                    $where .= $filtros[$k]['columna'] . " BETWEEN ";
                                                } else {
                                                    $where .= " AND ";
                                                }
                                                $where .= "'" . $fecha . "'";

                                                break;
                                            case 'varchar':
                                            case 'bpchar':
                                                //$whereEqueals .= $filtros[$k]['columna']." ILIKE '".$filtros[$k]['valor']."'";
                                                $where .= $filtros[$k]['columna'] . " ILIKE '" . $col . "'";
                                                break;
                                        }
                                        $ini++;
                                        if ($ini == count($arr_val)) {
                                            $where .= ") ";
                                        }
                                    }
                                }
                                break;
                            case 'LESS_THAN_OR_EQUAL':
                                $cond_fil .= utf8_encode(" que sea menor o igual que:  " . $filtros[$k]['valor']);
                                $where .= $filtros[$k]['columna'] . ' <= "' . $filtros[$k]['valor'] . '"';
                                break;
                        }
                        $yaConsiderados[] = $filtros[$k]['columna'];
                    }
                } else {
                    switch ($filtros[$k]['condicion']) {
                        case 'EMPTY':
                            $cond_fil .= utf8_encode(" que sea vacía ");
                            $where .= "(" . $filtros[$k]['columna'] . " IS NULL OR " . $filtros[$k]['columna'] . " ILIKE '')";
                            break;
                        case 'NOT_EMPTY':
                            $cond_fil .= utf8_encode(" que no sea vacía ");
                            $where .= "(" . $filtros[$k]['columna'] . " IS NOT NULL OR " . $filtros[$k]['columna'] . " NOT ILIKE '')";
                            break;
                        case 'CONTAINS':
                            $cond_fil .= utf8_encode(" que contenga el valor:  " . $filtros[$k]['valor']);
                            $where .= $filtros[$k]['columna'] . " ILIKE '%" . $filtros[$k]['valor'] . "%'";
                            break;
                        case 'EQUAL':
                            $cond_fil .= utf8_encode(" que contenga el valor:  " . $filtros[$k]['valor']);
                            if (isset($generalConfigForAllColumns[$filtros[$k]['columna']]['type'])) {
                                //$where .= $filtros[$k]['columna']." ILIKE '".$filtros[$k]['valor']."'";
                                switch (@$generalConfigForAllColumns[$filtros[$k]['columna']]['type']) {
                                    case 'int4':
                                    case 'numeric':
                                    case 'date':
                                        //$whereEqueals .= $filtros[$k]['columna']." = '".$filtros[$k]['valor']."'";
                                        $where .= $filtros[$k]['columna'] . " = '" . $filtros[$k]['valor'] . "'";
                                        break;
                                    case 'varchar':
                                    case 'bpchar':
                                        //$whereEqueals .= $filtros[$k]['columna']." ILIKE '".$filtros[$k]['valor']."'";
                                        $where .= $filtros[$k]['columna'] . " ILIKE '" . $filtros[$k]['valor'] . "'";
                                        break;
                                }
                            }
                            break;
                        case 'GREATER_THAN_OR_EQUAL':
                            $cond_fil .= utf8_encode(" que sea mayor o igual que:  " . $filtros[$k]['valor']);
                            $where .= $filtros[$k]['columna'] . ' >= "' . $filtros[$k]['valor'] . '"';
                            break;
                        case 'LESS_THAN_OR_EQUAL':
                            $cond_fil .= utf8_encode(" que sea menor o igual que:  " . $filtros[$k]['valor']);
                            $where .= $filtros[$k]['columna'] . ' <= "' . $filtros[$k]['valor'] . '"';
                            break;
                    }
                }

            }
            $obj = new Fhorariosymarcaciones();
            if ($where != "") $where = " WHERE " . $where;
            $groups_aux = "";
            if ($groups != "") {
                /**
                 * Se verifica que no se considere la columna nombres debido a que contenido ya esta ordenado por las
                 * columnas p_apellido, s_apellido, c_apellido, p_anombre, s_nombre, t_nombre
                 */
                /*if (strrpos($groups, "nombres")) {
                    if (strrpos($groups, ",")) {
                        $arr = explode(",", $groups);
                        foreach ($arr as $val) {
                            if ($val != "nombres")
                                $groups_aux[] = $val;
                        }
                        $groups = implode(",", $groups_aux);
                    } else $groups = "";
                }*/
                if (is_array($sorteds) && count($sorteds) > 0) {
                    if ($groups != "") $groups .= ",";
                    $coma = "";
                    if ($pdf->debug == 1) {
                        echo "<p>===========================================Orden======================================</p>";
                        print_r($sorteds);
                        echo "<p>===========================================Orden======================================</p>";
                    }
                    foreach ($sorteds as $ord => $orden) {
                        $groups .= $coma . $ord;
                        if ($orden['asc'] == '') $groups .= " ASC"; else$groups .= " DESC";
                        $coma = ",";
                    }
                }
                if ($groups != "")
                    $groups = " ORDER BY " . $groups . ",relaboral_id,gestion,mes,turno,modalidadmarcacion_id";
                if ($pdf->debug == 1) echo "<p>La consulta es: " . $groups . "<p>";
            } else {
                if (is_array($sorteds) && count($sorteds) > 0) {
                    $coma = "";
                    if ($pdf->debug == 1) {
                        echo "<p>===========================================Orden======================================</p>";
                        print_r($sorteds);
                        echo "<p>===========================================Orden======================================</p>";
                    }
                    foreach ($sorteds as $ord => $orden) {
                        $groups .= $coma . $ord;
                        if ($orden['asc'] == '') $groups .= " ASC"; else$groups .= " DESC";
                        $coma = ",";
                    }
                    $groups = " ORDER BY " . $groups;
                }

            }
            if ($pdf->debug == 1) echo "<p>WHERE------------------------->" . $where . "<p>";
            if ($pdf->debug == 1) echo "<p>GROUP BY------------------------->" . $groups . "<p>";
            $resul = $obj->getAll("WHERE relaboral_id=".$idRelaboral,$groups);

            $horariosymarcaciones = array();
            foreach ($resul as $v) {
                $horariosymarcaciones[] = array(
                    #region Columnas de procedimiento f_relaborales()
                    'id_relaboral' => $v->id_relaboral,
                    'id_persona' => $v->id_persona,
                    'p_nombre' => $v->p_nombre,
                    's_nombre' => $v->s_nombre,
                    't_nombre' => $v->t_nombre,
                    'p_apellido' => $v->p_apellido,
                    's_apellido' => $v->s_apellido,
                    'c_apellido' => $v->c_apellido,
                    'nombres' => $v->nombres,
                    'ci' => $v->ci,
                    'expd' => $v->expd,
                    'cargo' => $v->cargo,
                    'sueldo' => str_replace(".00", "", $v->sueldo),
                    'condicion' => $v->condicion,
                    'gerencia_administrativa' => $v->gerencia_administrativa,
                    'departamento_administrativo' => $v->departamento_administrativo,
                    'area' => $v->area,
                    'ubicacion' => $v->ubicacion,
                    #endregion Columnas de procedimiento f_relaborales()

                    'id'=>$v->id_horarioymarcacion,
                    'relaboral_id'=>$v->relaboral_id,
                    'gestion'=>$v->gestion,
                    'mes'=>$v->mes,
                    'mes_nombre'=>$v->mes_nombre,
                    'turno'=>$v->turno,
                    'grupo'=>$v->grupo,
                    'clasemarcacion'=>$v->clasemarcacion,
                    'clasemarcacion_descripcion'=>$v->clasemarcacion_descripcion,
                    'modalidadmarcacion_id'=>$v->modalidadmarcacion_id,
                    'modalidad_marcacion'=>$v->modalidad_marcacion,
                    'd1'=>$v->d1,
                    'calendariolaboral1_id'=>$v->calendariolaboral1_id,
                    'd2'=>$v->d2,
                    'calendariolaboral2_id'=>$v->calendariolaboral2_id,
                    'd3'=>$v->d3,
                    'calendariolaboral3_id'=>$v->calendariolaboral3_id,
                    'd4'=>$v->d4,
                    'calendariolaboral4_id'=>$v->calendariolaboral4_id,
                    'd5'=>$v->d5,
                    'calendariolaboral5_id'=>$v->calendariolaboral5_id,
                    'd6'=>$v->d6,
                    'calendariolaboral6_id'=>$v->calendariolaboral6_id,
                    'd7'=>$v->d7,
                    'calendariolaboral7_id'=>$v->calendariolaboral7_id,
                    'd8'=>$v->d8,
                    'calendariolaboral8_id'=>$v->calendariolaboral8_id,
                    'd9'=>$v->d9,
                    'calendariolaboral9_id'=>$v->calendariolaboral9_id,
                    'd10'=>$v->d10,
                    'calendariolaboral10_id'=>$v->calendariolaboral10_id,
                    'd11'=>$v->d11,
                    'calendariolaboral11_id'=>$v->calendariolaboral11_id,
                    'd12'=>$v->d12,
                    'calendariolaboral12_id'=>$v->calendariolaboral12_id,
                    'd13'=>$v->d13,
                    'calendariolaboral13_id'=>$v->calendariolaboral13_id,
                    'd14'=>$v->d14,
                    'calendariolaboral14_id'=>$v->calendariolaboral14_id,
                    'd15'=>$v->d15,
                    'calendariolaboral15_id'=>$v->calendariolaboral15_id,
                    'd16'=>$v->d16,
                    'calendariolaboral16_id'=>$v->calendariolaboral16_id,
                    'd17'=>$v->d17,
                    'calendariolaboral17_id'=>$v->calendariolaboral17_id,
                    'd18'=>$v->d18,
                    'calendariolaboral18_id'=>$v->calendariolaboral18_id,
                    'd19'=>$v->d19,
                    'calendariolaboral19_id'=>$v->calendariolaboral19_id,
                    'd20'=>$v->d20,
                    'calendariolaboral20_id'=>$v->calendariolaboral20_id,
                    'd21'=>$v->d21,
                    'calendariolaboral21_id'=>$v->calendariolaboral21_id,
                    'd22'=>$v->d22,
                    'calendariolaboral22_id'=>$v->calendariolaboral22_id,
                    'd23'=>$v->d23,
                    'calendariolaboral23_id'=>$v->calendariolaboral23_id,
                    'd24'=>$v->d24,
                    'calendariolaboral24_id'=>$v->calendariolaboral24_id,
                    'd25'=>$v->d25,
                    'calendariolaboral25_id'=>$v->calendariolaboral25_id,
                    'd26'=>$v->d26,
                    'calendariolaboral26_id'=>$v->calendariolaboral26_id,
                    'd27'=>$v->d27,
                    'calendariolaboral27_id'=>$v->calendariolaboral27_id,
                    'd28'=>$v->d28,
                    'calendariolaboral28_id'=>$v->calendariolaboral28_id,
                    'd29'=>$v->d29,
                    'calendariolaboral29_id'=>$v->calendariolaboral29_id,
                    'd30'=>$v->d30,
                    'calendariolaboral30_id'=>$v->calendariolaboral30_id,
                    'd31'=>$v->d31,
                    'calendariolaboral31_id'=>$v->calendariolaboral31_id,
                    'ultimo_dia'=>$v->ultimo_dia,
                    'atrasos'=>$v->atrasos,
                    'faltas'=>$v->faltas,
                    'abandono'=>$v->abandono,
                    'omision'=>$v->omision,
                    'lsgh'=>$v->lsgh,
                    'compensacion'=>$v->compensacion,
                    'estado'=>$v->estado,
                    'estado_descripcion'=>$v->estado_descripcion,
                    'baja_logica'=>$v->baja_logica,
                    'agrupador'=>$v->agrupador,
                    'user_reg_id'=>$v->user_reg_id,
                    'fecha_reg'=>$v->fecha_reg,
                    'user_apr_id'=>$v->user_apr_id,
                    'fecha_apr'=>$v->fecha_apr,
                    'user_mod_id'=>$v->user_mod_id,
                    'fecha_mod'=>$v->fecha_mod,
                );
                #region sector para adicionar una fila para Excepciones
                if($v->modalidadmarcacion_id==6){
                    $d1=$d2=$d3=$d4=$d5=$d6=$d7=$d8=$d9=$d10=$d11=$d12=$d13=$d14=$d15=$d16=$d17=$d18=$d19=$d20=$d21=$d22=$d23=$d24=$d25=$d26=$d27=$d28=$d29=$d30=$d30=$d31="";
                    if($v->calendariolaboral1_id>0){
                        $res1 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,1,$v->calendariolaboral1_id);
                        if(is_object($res1)&&$res1->count()>0){
                            foreach($res1 as $r1){
                                $d1 = $r1->f_excepciones_en_dia;
                            }
                        }
                    }
                    if($v->calendariolaboral2_id>0){
                        $res2 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,2,$v->calendariolaboral2_id,1);
                        if(is_object($res2)&&$res2->count()>0){
                            foreach($res2 as $r2){
                                $d2 = $r2->f_excepciones_en_dia;
                            }

                        }
                    }
                    if($v->calendariolaboral3_id>0){
                        $res3 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,3,$v->calendariolaboral3_id,1);
                        if(is_object($res3)&&$res3->count()>0){
                            foreach($res3 as $r3){
                                $d3 = $r3->f_excepciones_en_dia;
                            }

                        }
                    }

                    if($v->calendariolaboral4_id>0){
                        $res4 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,4,$v->calendariolaboral4_id,1);
                        if(is_object($res4)&&$res4->count()>0){
                            foreach($res4 as $r4){
                                $d4 = $r4->f_excepciones_en_dia;
                            }

                        }
                    }
                    if($v->calendariolaboral5_id>0){
                        $res5 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,5,$v->calendariolaboral5_id,1);
                        if(is_object($res5)&&$res5->count()>0){
                            foreach($res5 as $r5){
                                $d5 = $r5->f_excepciones_en_dia;
                            }

                        }
                    }
                    if($v->calendariolaboral6_id>0){
                        $res6 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,6,$v->calendariolaboral6_id,1);
                        if(is_object($res6)&&$res6->count()>0){
                            foreach($res6 as $r6){
                                $d6 = $r6->f_excepciones_en_dia;
                            }

                        }
                    }
                    if($v->calendariolaboral7_id>0){
                        $res7 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,7,$v->calendariolaboral7_id,1);
                        if(is_object($res7)&&$res7->count()>0){
                            foreach($res7 as $r7){
                                $d7 = $r7->f_excepciones_en_dia;
                            }

                        }
                    }
                    if($v->calendariolaboral8_id>0){
                        $res8 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,8,$v->calendariolaboral8_id,1);
                        if(is_object($res8)&&$res8->count()>0){
                            foreach($res8 as $r8){
                                $d8 = $r8->f_excepciones_en_dia;
                            }

                        }
                    }
                    if($v->calendariolaboral9_id>0){
                        $res9 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,9,$v->calendariolaboral9_id,1);
                        if(is_object($res9)&&$res9->count()>0){
                            foreach($res9 as $r9){
                                $d9 = $r9->f_excepciones_en_dia;
                            }

                        }
                    }
                    if($v->calendariolaboral10_id>0){
                        $res10 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,10,$v->calendariolaboral10_id,1);
                        if(is_object($res10)&&$res10->count()>0){
                            foreach($res10 as $r10){
                                $d10 = $r10->f_excepciones_en_dia;
                            }

                        }
                    }
                    if($v->calendariolaboral11_id>0){
                        $res11 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,11,$v->calendariolaboral11_id,1);
                        if(is_object($res11)&&$res11->count()>0){
                            foreach($res11 as $r11){
                                $d11 = $r11->f_excepciones_en_dia;
                            }

                        }
                    }
                    if($v->calendariolaboral12_id>0){
                        $res12 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,12,$v->calendariolaboral12_id,1);
                        if(is_object($res12)&&$res12->count()>0){
                            foreach($res12 as $r12){
                                $d12 = $r12->f_excepciones_en_dia;
                            }

                        }
                    }

                    if($v->calendariolaboral13_id>0){
                        $res13 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,13,$v->calendariolaboral13_id,1);
                        if(is_object($res13)&&$res13->count()>0){
                            foreach($res13 as $r13){
                                $d13 = $r13->f_excepciones_en_dia;
                            }

                        }
                    }

                    if($v->calendariolaboral14_id>0){
                        $res14 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,14,$v->calendariolaboral14_id,1);
                        if(is_object($res14)&&$res14->count()>0){
                            foreach($res14 as $r14){
                                $d14 = $r14->f_excepciones_en_dia;
                            }

                        }
                    }
                    if($v->calendariolaboral15_id>0){
                        $res15 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,15,$v->calendariolaboral15_id,1);
                        if(is_object($res15)&&$res15->count()>0){
                            foreach($res15 as $r15){
                                $d15 = $r15->f_excepciones_en_dia;
                            }

                        }
                    }
                    if($v->calendariolaboral16_id>0){
                        $res16 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,16,$v->calendariolaboral16_id,1);
                        if(is_object($res16)&&$res16->count()>0){
                            foreach($res16 as $r16){
                                $d16 = $r16->f_excepciones_en_dia;
                            }

                        }
                    }
                    if($v->calendariolaboral17_id>0){
                        $res17 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,17,$v->calendariolaboral17_id,1);
                        if(is_object($res17)&&$res17->count()>0){
                            foreach($res17 as $r17){
                                $d17 = $r17->f_excepciones_en_dia;
                            }

                        }
                    }
                    if($v->calendariolaboral18_id>0){
                        $res18 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,18,$v->calendariolaboral18_id,1);
                        if(is_object($res18)&&$res18->count()>0){
                            foreach($res18 as $r){
                                $d18 = $r->f_excepciones_en_dia;
                            }

                        }
                    }
                    if($v->calendariolaboral19_id>0){
                        $res19 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,19,$v->calendariolaboral19_id,1);
                        if(is_object($res19)&&$res19->count()>0){
                            foreach($res19 as $r){
                                $d19 = $r->f_excepciones_en_dia;
                            }

                        }
                    }
                    if($v->calendariolaboral20_id>0){
                        $res20 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,20,$v->calendariolaboral20_id,1);
                        if(is_object($res20)&&$res20->count()>0){
                            foreach($res20 as $r){
                                $d20 = $r->f_excepciones_en_dia;
                            }

                        }
                    }
                    if($v->calendariolaboral21_id>0){
                        $res21 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,21,$v->calendariolaboral21_id,1);
                        if(is_object($res21)&&$res21->count()>0){
                            foreach($res21 as $r21){
                                $d21 = $r21->f_excepciones_en_dia;
                            }

                        }
                    }
                    if($v->calendariolaboral22_id>0){
                        $res22 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,22,$v->calendariolaboral22_id,1);
                        if(is_object($res22)&&$res22->count()>0){
                            foreach($res22 as $r22){
                                $d22 = $r22->f_excepciones_en_dia;
                            }

                        }
                    }
                    if($v->calendariolaboral23_id>0){
                        $res23 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,23,$v->calendariolaboral23_id,1);
                        if(is_object($res23)&&$res23->count()>0){
                            foreach($res23 as $r23){
                                $d23 = $r23->f_excepciones_en_dia;
                            }

                        }
                    }
                    if($v->calendariolaboral24_id>0){
                        $res24 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,24,$v->calendariolaboral24_id,1);
                        if(is_object($res24)&&$res24->count()>0){
                            foreach($res24 as $r24){
                                $d24 = $r24->f_excepciones_en_dia;
                            }

                        }
                    }
                    if($v->calendariolaboral25_id>0){
                        $res25 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,25,$v->calendariolaboral25_id,1);
                        if(is_object($res25)&&$res25->count()>0){
                            foreach($res25 as $r25){
                                $d25 = $r25->f_excepciones_en_dia;
                            }

                        }
                    }
                    if($v->calendariolaboral26_id>0){
                        $res26 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,26,$v->calendariolaboral26_id,1);
                        if(is_object($res26)&&$res26->count()>0){
                            foreach($res26 as $r26){
                                $d26 = $r26->f_excepciones_en_dia;
                            }

                        }
                    }
                    if($v->calendariolaboral27_id>0){
                        $res27 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,27,$v->calendariolaboral27_id,1);
                        if(is_object($res27)&&$res27->count()>0){
                            foreach($res27 as $r27){
                                $d27 = $r27->f_excepciones_en_dia;
                            }

                        }
                    }
                    if($v->calendariolaboral28_id>0){
                        $res28 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,28,$v->calendariolaboral28_id,1);
                        if(is_object($res28)&&$res28->count()>0){
                            foreach($res28 as $r28){
                                $d28 = $r28->f_excepciones_en_dia;
                            }

                        }
                    }
                    if($v->calendariolaboral29_id>0){
                        $res29 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,29,$v->calendariolaboral29_id,1);
                        if(is_object($res29)&&$res29->count()>0){
                            foreach($res29 as $r29){
                                $d29 = $r29->f_excepciones_en_dia;
                            }

                        }
                    }
                    if($v->calendariolaboral30_id>0){
                        $res30 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,30,$v->calendariolaboral30_id,1);
                        if(is_object($res30)&&$res30->count()>0){
                            foreach($res30 as $r30){
                                $d30 = $r30->f_excepciones_en_dia;
                            }

                        }
                    }
                    if($v->calendariolaboral31_id>0){
                        $res31 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,31,$v->calendariolaboral31_id,1);
                        if(is_object($res31)&&$res31->count()>0){
                            foreach($res31 as $r31){
                                $d31 = $r31->f_excepciones_en_dia;
                            }

                        }
                    }
                    $horariosymarcaciones[] = array(
                        #region Columnas de procedimiento f_relaborales()
                        'id_relaboral' => $v->id_relaboral,
                        'id_persona' => $v->id_persona,
                        'p_nombre' => $v->p_nombre,
                        's_nombre' => $v->s_nombre,
                        't_nombre' => $v->t_nombre,
                        'p_apellido' => $v->p_apellido,
                        's_apellido' => $v->s_apellido,
                        'c_apellido' => $v->c_apellido,
                        'nombres' => $v->nombres,
                        'ci' => $v->ci,
                        'expd' => $v->expd,
                        'cargo' => $v->cargo,
                        'sueldo' => str_replace(".00", "", $v->sueldo),
                        'condicion' => $v->condicion,
                        'gerencia_administrativa' => $v->gerencia_administrativa,
                        'departamento_administrativo' => $v->departamento_administrativo,
                        'area' => $v->area,
                        'ubicacion' => $v->ubicacion,
                        #endregion Columnas de procedimiento f_relaborales()

                        'id'=>$v->id_horarioymarcacion,
                        'relaboral_id'=>$v->relaboral_id,
                        'gestion'=>$v->gestion,
                        'mes'=>$v->mes,
                        'mes_nombre'=>$v->mes_nombre,
                        'turno'=>$v->turno,
                        'grupo'=>$v->grupo,
                        'clasemarcacion'=>"e",
                        'clasemarcacion_descripcion'=>"EXCEPCIONES",
                        'modalidadmarcacion_id'=>$v->modalidadmarcacion_id,
                        'modalidad_marcacion'=>"EXCEPCIONES",
                        'd1'=>$d1,
                        'calendariolaboral1_id'=>$v->calendariolaboral1_id,
                        'd2'=>$d2,
                        'calendariolaboral2_id'=>$v->calendariolaboral2_id,
                        'd3'=>$d3,
                        'calendariolaboral3_id'=>$v->calendariolaboral3_id,
                        'd4'=>$d4,
                        'calendariolaboral4_id'=>$v->calendariolaboral4_id,
                        'd5'=>$d5,
                        'calendariolaboral5_id'=>$v->calendariolaboral5_id,
                        'd6'=>$d6,
                        'calendariolaboral6_id'=>$v->calendariolaboral6_id,
                        'd7'=>$d7,
                        'calendariolaboral7_id'=>$v->calendariolaboral7_id,
                        'd8'=>$d8,
                        'calendariolaboral8_id'=>$v->calendariolaboral8_id,
                        'd9'=>$d9,
                        'calendariolaboral9_id'=>$v->calendariolaboral9_id,
                        'd10'=>$d10,
                        'calendariolaboral10_id'=>$v->calendariolaboral10_id,
                        'd11'=>$d11,
                        'calendariolaboral11_id'=>$v->calendariolaboral11_id,
                        'd12'=>$d12,
                        'calendariolaboral12_id'=>$v->calendariolaboral12_id,
                        'd13'=>$d13,
                        'calendariolaboral13_id'=>$v->calendariolaboral13_id,
                        'd14'=>$d14,
                        'calendariolaboral14_id'=>$v->calendariolaboral14_id,
                        'd15'=>$d15,
                        'calendariolaboral15_id'=>$v->calendariolaboral15_id,
                        'd16'=>$d16,
                        'calendariolaboral16_id'=>$v->calendariolaboral16_id,
                        'd17'=>$d17,
                        'calendariolaboral17_id'=>$v->calendariolaboral17_id,
                        'd18'=>$d18,
                        'calendariolaboral18_id'=>$v->calendariolaboral18_id,
                        'd19'=>$d19,
                        'calendariolaboral19_id'=>$v->calendariolaboral19_id,
                        'd20'=>$d20,
                        'calendariolaboral20_id'=>$v->calendariolaboral20_id,
                        'd21'=>$d21,
                        'calendariolaboral21_id'=>$v->calendariolaboral21_id,
                        'd22'=>$d22,
                        'calendariolaboral22_id'=>$v->calendariolaboral22_id,
                        'd23'=>$d23,
                        'calendariolaboral23_id'=>$v->calendariolaboral23_id,
                        'd24'=>$d24,
                        'calendariolaboral24_id'=>$v->calendariolaboral24_id,
                        'd25'=>$d25,
                        'calendariolaboral25_id'=>$v->calendariolaboral25_id,
                        'd26'=>$d26,
                        'calendariolaboral26_id'=>$v->calendariolaboral26_id,
                        'd27'=>$d27,
                        'calendariolaboral27_id'=>$v->calendariolaboral27_id,
                        'd28'=>$d28,
                        'calendariolaboral28_id'=>$v->calendariolaboral28_id,
                        'd29'=>$d29,
                        'calendariolaboral29_id'=>$v->calendariolaboral29_id,
                        'd30'=>$d30,
                        'calendariolaboral30_id'=>$v->calendariolaboral30_id,
                        'd31'=>$d31,
                        'calendariolaboral31_id'=>$v->calendariolaboral31_id,
                        'ultimo_dia'=>$v->ultimo_dia,
                        'atrasos'=>null,
                        'faltas'=>null,
                        'abandono'=>null,
                        'omision'=>null,
                        'lsgh'=>null,
                        'compensacion'=>null,
                        'observacion'=>$v->observacion,
                        'estado'=>$v->estado,
                        'estado_descripcion'=>$v->estado_descripcion,
                        'baja_logica'=>$v->baja_logica,
                        'agrupador'=>$v->agrupador,
                        'user_reg_id'=>$v->user_reg_id,
                        'fecha_reg'=>$v->fecha_reg,
                        'user_apr_id'=>$v->user_apr_id,
                        'fecha_apr'=>$v->fecha_apr,
                        'user_mod_id'=>$v->user_mod_id,
                        'fecha_mod'=>$v->fecha_mod,
                    );
                }
                #endregion sector para adicionar una fila para Excepciones
            }
            //$pdf->Open("L");
            /**
             * Si el ancho supera el establecido para una hoja tamaño carta, se la pone en posición horizontal
             */

            $pdf->AddPage();
            if ($pdf->debug == 1) {
                echo "<p>El ancho es:: " . $ancho;
            }
            #region Espacio para la definición de valores para la cabecera de la tabla
            $pdf->FechaHoraReporte = date("d-m-Y H:i:s");
            $j = 0;
            $agrupadores = array();
            //echo "<p>++++++++++>".$groups;
            if ($groups != "")
                $agrupadores = explode(",", $groups);

            $dondeCambio = array();
            $queCambio = array();

            if (count($horariosymarcaciones) > 0){
                foreach ($horariosymarcaciones as $i => $val) {
                    if (($pdf->pageWidth - $pdf->tableWidth) > 0) $pdf->SetX(($pdf->pageWidth - $pdf->tableWidth) / 2);
                    if (count($agrupadores) > 0) {
                        if ($pdf->debug == 1) {
                            echo "<p>|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||<p></p>";
                            print_r($gruposSeleccionadosActuales);
                            echo "<p>|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||<p></p>";
                        }
                        $agregarAgrupador = 0;
                        $aux = array();
                        $dondeCambio = array();
                        foreach ($gruposSeleccionadosActuales as $key => $valor) {
                            if ($valor != $val[$key]) {
                                $agregarAgrupador = 1;
                                $aux[$key] = $val[$key];
                                $dondeCambio[] = $key;
                                $queCambio[$key] = $val[$key];
                            } else {
                                $aux[$key] = $val[$key];
                            }
                        }
                        $gruposSeleccionadosActuales = $aux;
                        if ($agregarAgrupador == 1) {
                            $pdf->Ln();
                            $pdf->DefineColorHeaderTable();
                            $pdf->SetAligns($alignTitleSelecteds);
                            //if(($pdf->pageWidth-$pdf->tableWidth)>0)$pdf->SetX(($pdf->pageWidth-$pdf->tableWidth)/2);
                            $agr = $pdf->DefineTitleColsByGroups($generalConfigForAllColumns, $dondeCambio, $queCambio);
                            $pdf->Agrupador($agr);
                            $pdf->RowTitle($colTitleSelecteds);
                        }
                        $pdf->DefineColorBodyTable();
                        $pdf->SetAligns($alignSelecteds);
                        if (($pdf->pageWidth - $pdf->tableWidth) > 0) $pdf->SetX(($pdf->pageWidth - $pdf->tableWidth) / 2);
                        $rowData = $pdf->DefineRows($j + 1, $horariosymarcaciones[$j], $colSelecteds);
                        $pdf->Row($rowData);

                    } else {
                        //if(($pdf->pageWidth-$pdf->tableWidth)>0)$pdf->SetX(($pdf->pageWidth-$pdf->tableWidth)/2);
                        if($pdf->debug==1){
                            echo "<p>***********************************VALOR POR LA LINEA ".($j + 1)."***************************************************</p>";
                            print_r($val);
                            echo "<p>***************************************************************************************</p>";
                        }
                        $pdf->DefineColorBodyTable();
                        $pdf->SetAligns($alignSelecteds);
                        $rowData = $pdf->DefineRows($j + 1, $val, $colSelecteds);
                        $pdf->Row($rowData);
                    }
                    //if(($pdf->pageWidth-$pdf->tableWidth)>0)$pdf->SetX(($pdf->pageWidth-$pdf->tableWidth)/2);
                    $j++;
                }
            }
            $pdf->ShowLeftFooter = true;
            if($pdf->debug==0)$pdf->Output('reporte_marcaciones.pdf','I');
            #endregion Proceso de generación del documento PDF
        }
    }
    /**
     * Función para el despliegue del reporte de cálculos de marcaciones en formato PDF.
     * @param $ci Carnet de identidad.
     * @param $fechaIni Fecha de inicio del rango del reporte.
     * @param $fechaFin Fecha de finalización del rango del reporte.
     * @param $n_rows Cantidad de registros.
     * @param $columns Array con las columnas a considerarse.
     * @param $filtros Array de los filtros aplicados.
     * @param $groups Array de las agrupaciones aplicadas.
     * @param $sorteds Array de los órdenes aplicados.
     */
    public function exportcalculospdfAction($ci,$fechaIni,$fechaFin,$n_rows, $columns, $filtros,$groups,$sorteds)
    {   $columns = base64_decode(str_pad(strtr($columns, '-_', '+/'), strlen($columns) % 4, '=', STR_PAD_RIGHT));
        $filtros = base64_decode(str_pad(strtr($filtros, '-_', '+/'), strlen($columns) % 4, '=', STR_PAD_RIGHT));
        $groups = base64_decode(str_pad(strtr($groups, '-_', '+/'), strlen($groups) % 4, '=', STR_PAD_RIGHT));
        if($groups=='null'||$groups==null)$groups="";
        $sorteds = base64_decode(str_pad(strtr($sorteds, '-_', '+/'), strlen($sorteds) % 4, '=', STR_PAD_RIGHT));
        $columns = json_decode($columns, true);
        $filtros = json_decode($filtros, true);
        $sub_keys = array_keys($columns);//echo $sub_keys[0];
        $n_col = count($columns);//echo$keys[1];
        $sorteds = json_decode($sorteds, true);
        /**
         * Especificando la configuración de las columnas
         */
        $generalConfigForAllColumns = array(
            'nro_row' => array('title' => 'Nro.', 'width' => 8, 'title-align'=>'C','align' => 'C', 'type' => 'int4','totales'=>false),
            'ubicacion' => array('title' => 'Ubicacion', 'width' => 20, 'align' => 'C', 'type' => 'varchar','totales'=>false),
            'condicion' => array('title' => 'Condicion', 'width' => 20, 'align' => 'C', 'type' => 'varchar','totales'=>false),
            'nombres' => array('title' => 'Nombres', 'width' => 30, 'align' => 'L', 'type' => 'varchar','totales'=>true),
            'ci' => array('title' => 'CI', 'width' => 15, 'align' => 'C', 'type' => 'varchar','totales'=>true),
            'expd' => array('title' => 'Exp.', 'width' => 8, 'align' => 'C', 'type' => 'bpchar','totales'=>true),
            'gerencia_administrativa' => array('title' => 'Gerencia', 'width' => 30, 'align' => 'L', 'type' => 'varchar','totales'=>true),
            'departamento_administrativo' => array('title' => 'Departamento', 'width' => 30, 'align' => 'L', 'type' => 'varchar','totales'=>true),
            'area' => array('title' => 'Area', 'width' => 20, 'align' => 'L', 'type' => 'varchar','totales'=>true),
            'cargo' => array('title' => 'Cargo', 'width' => 30, 'align' => 'L', 'type' => 'varchar','totales'=>true),
            'sueldo' => array('title' => 'Haber', 'width' => 10, 'align' => 'R', 'type' => 'numeric','totales'=>true),
            'estado_descripcion' => array('title' => 'Estado', 'width' => 15, 'align' => 'C', 'type' => 'varchar','totales'=>false),
            'gestion' => array('title' => 'Gestion', 'width' => 15, 'align' => 'C', 'type' => 'numeric','totales'=>true),
            'mes_nombre' => array('title' => 'Mes', 'width' => 20, 'align' => 'C', 'type' => 'varchar','totales'=>true),
            'turno' => array('title' => 'Turno', 'width' => 10, 'align' => 'C', 'type' => 'numeric','totales'=>false),
            'modalidad_marcacion' => array('title' => 'Modalidad', 'width' => 30, 'align' => 'C', 'type' => 'varchar','totales'=>false),
            'd1' => array('title' => 'Dia 1', 'width' => 18, 'align' => 'C', 'type' => 'date','totales'=>false),
            /*'estado1_descripcion' => array('title' => 'Estado Dia 1', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd2' => array('title' => 'Dia 2', 'width' => 18, 'align' => 'C', 'type' => 'date','totales'=>false),
            /*'estado2_descripcion' => array('title' => 'Estado Dia 2', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd3' => array('title' => 'Dia 3', 'width' => 18, 'align' => 'C', 'type' => 'date','totales'=>false),
            /*'estado3_descripcion' => array('title' => 'Estado Dia 3', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd4' => array('title' => 'Dia 4', 'width' => 18, 'align' => 'C', 'type' => 'date','totales'=>false),
            /*'estado4_descripcion' => array('title' => 'Estado Dia 4', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd5' => array('title' => 'Dia 5', 'width' => 18, 'align' => 'C', 'type' => 'date','totales'=>false),
            /*'estado5_descripcion' => array('title' => 'Estado Dia 5', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd6' => array('title' => 'Dia 6', 'width' => 18, 'align' => 'C', 'type' => 'date','totales'=>false),
            /*'estado6_descripcion' => array('title' => 'Estado Dia 6', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd7' => array('title' => 'Dia 7', 'width' => 18, 'align' => 'C', 'type' => 'date','totales'=>false),
            /*'estado7_descripcion' => array('title' => 'Estado Dia 7', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd8' => array('title' => 'Dia 8', 'width' => 18, 'align' => 'C', 'type' => 'date','totales'=>false),
            /*'estado8_descripcion' => array('title' => 'Estado Dia 8', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd9' => array('title' => 'Dia 9', 'width' => 18, 'align' => 'C', 'type' => 'date','totales'=>false),
            /*'estado9_descripcion' => array('title' => 'Estado Dia 9', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd10' => array('title' => 'Dia 10', 'width' => 18, 'align' => 'C', 'type' => 'date','totales'=>false),
            /*'estado10_descripcion' => array('title' => 'Estado Dia 10', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd11' => array('title' => 'Dia 11', 'width' => 18, 'align' => 'C', 'type' => 'date','totales'=>false),
            /*'estado11_descripcion' => array('title' => 'Estado Dia 11', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd12' => array('title' => 'Dia 12', 'width' => 18, 'align' => 'C', 'type' => 'date','totales'=>false),
            /*'estado12_descripcion' => array('title' => 'Estado Dia 12', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd13' => array('title' => 'Dia 13', 'width' => 18, 'align' => 'C', 'type' => 'date','totales'=>false),
            /*'estado13_descripcion' => array('title' => 'Estado Dia 13', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd14' => array('title' => 'Dia 14', 'width' => 18, 'align' => 'C', 'type' => 'date','totales'=>false),
            /*'estado14_descripcion' => array('title' => 'Estado Dia 14', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd15' => array('title' => 'Dia 15', 'width' => 18, 'align' => 'C', 'type' => 'date','totales'=>false),
            /*'estado15_descripcion' => array('title' => 'Estado Dia 15', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd16' => array('title' => 'Dia 16', 'width' => 18, 'align' => 'C', 'type' => 'date','totales'=>false),
            /*'estado16_descripcion' => array('title' => 'Estado Dia 16', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd17' => array('title' => 'Dia 17', 'width' => 18, 'align' => 'C', 'type' => 'date','totales'=>false),
            /*'estado17_descripcion' => array('title' => 'Estado Dia 17', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd18' => array('title' => 'Dia 18', 'width' => 18, 'align' => 'C', 'type' => 'date','totales'=>false),
            /*'estado18_descripcion' => array('title' => 'Estado Dia 18', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd19' => array('title' => 'Dia 19', 'width' => 18, 'align' => 'C', 'type' => 'date','totales'=>false),
            /*'estado19_descripcion' => array('title' => 'Estado Dia 19', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd20' => array('title' => 'Dia 20', 'width' => 18, 'align' => 'C', 'type' => 'date','totales'=>false),
            /*'estado20_descripcion' => array('title' => 'Estado Dia 20', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd21' => array('title' => 'Dia 21', 'width' => 18, 'align' => 'C', 'type' => 'date','totales'=>false),
            /*'estado21_descripcion' => array('title' => 'Estado Dia 21', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd22' => array('title' => 'Dia 22', 'width' => 18, 'align' => 'C', 'type' => 'date','totales'=>false),
            /*'estado22_descripcion' => array('title' => 'Estado Dia 22', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd23' => array('title' => 'Dia 23', 'width' => 18, 'align' => 'C', 'type' => 'date','totales'=>false),
            /*'estado23_descripcion' => array('title' => 'Estado Dia 23', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd24' => array('title' => 'Dia 24', 'width' => 18, 'align' => 'C', 'type' => 'date','totales'=>false),
            /*'estado24_descripcion' => array('title' => 'Estado Dia 24', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd25' => array('title' => 'Dia 25', 'width' => 18, 'align' => 'C', 'type' => 'date','totales'=>false),
            /*'estado25_descripcion' => array('title' => 'Estado Dia 25', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd26' => array('title' => 'Dia 26', 'width' => 18, 'align' => 'C', 'type' => 'date','totales'=>false),
            /*'estado26_descripcion' => array('title' => 'Estado Dia 26', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd27' => array('title' => 'Dia 27', 'width' => 18, 'align' => 'C', 'type' => 'date','totales'=>false),
            /*'estado27_descripcion' => array('title' => 'Estado Dia 27', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd28' => array('title' => 'Dia 28', 'width' => 18, 'align' => 'C', 'type' => 'date','totales'=>false),
            /*'estado28_descripcion' => array('title' => 'Estado Dia 28', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd29' => array('title' => 'Dia 29', 'width' => 18, 'align' => 'C', 'type' => 'date','totales'=>false),
            /*'estado29_descripcion' => array('title' => 'Estado Dia 29', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd30' => array('title' => 'Dia 30', 'width' => 18, 'align' => 'C', 'type' => 'date','totales'=>false),
            /*'estado30_descripcion' => array('title' => 'Estado Dia 30', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd31' => array('title' => 'Dia 31', 'width' => 18, 'align' => 'C', 'type' => 'date','totales'=>false),
            /*'estado31_descripcion' => array('title' => 'Estado Dia 31', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'ultimo_dia' => array('title' => 'U/Dia', 'width' => 10, 'align' => 'C', 'type' => 'numeric','totales'=>false),
            'atrasos' => array('title' => 'Atrasos', 'width' => 15, 'align' => 'C', 'type' => 'numeric','totales'=>true),
            'faltas' => array('title' => 'Faltas', 'width' => 15, 'align' => 'C', 'type' => 'numeric','totales'=>true),
            'abandono' => array('title' => 'Abandono', 'width' => 18, 'align' => 'C', 'type' => 'numeric','totales'=>true),
            'omision' => array('title' => 'Omision', 'width' => 15, 'align' => 'C', 'type' => 'numeric','totales'=>true),
            'lsgh' => array('title' => 'LSGH', 'width' => 15, 'align' => 'C', 'type' => 'numeric','totales'=>true),
            'observacion' => array('title' => 'Obs.', 'width' => 30, 'align' => 'L', 'type' => 'varchar','totales'=>false)
        );
        $agruparPor = ($groups!="")?explode(",",$groups):array();
        $widthsSelecteds = $this->DefineWidths($generalConfigForAllColumns, $columns,$agruparPor);
        $ancho = 0;
        if(count($widthsSelecteds)>0) {
            foreach ($widthsSelecteds as $w) {
                $ancho = $ancho + $w;
            }
            if ($ancho > 215.9) {
                if ($ancho > 270) {
                    $pdf = new pdfoasis('L', 'mm', 'Legal');
                    $pdf->pageWidth = 355;
                } else {
                    $pdf = new pdfoasis('L', 'mm', 'Letter');
                    $pdf->pageWidth = 280;
                }
            } else {
                $pdf = new pdfoasis('P', 'mm', 'Letter');
                $pdf->pageWidth = 215.9;
            }
            $pdf->tableWidth = $ancho;
            #region Proceso de generación del documento PDF
            $pdf->debug = 0;
            $pdf->title_rpt = utf8_decode('Reporte Rango Marcaciones ('.$fechaIni.' al '.$fechaFin.')');
            $pdf->title_total_rpt = utf8_decode('Cuadro Resumen de Datos Marcaciones ('.$fechaIni.' al '.$fechaFin.')');
            $pdf->header_title_empresa_rpt = utf8_decode('Empresa Estatal de Transporte por Cable "Mi Teleférico"');
            $alignSelecteds = $pdf->DefineAligns($generalConfigForAllColumns, $columns, $agruparPor);
            $colSelecteds = $pdf->DefineCols($generalConfigForAllColumns, $columns, $agruparPor);
            if ($pdf->debug == 1) {
                echo "<p>^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^COLUMNAS A MOSTRARSE^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^(".count($colSelecteds).")</p>";
                print_r($colSelecteds);
                echo "<p>^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^";
            }
            $colTitleSelecteds = $pdf->DefineTitleCols($generalConfigForAllColumns, $columns, $agruparPor);
            $alignTitleSelecteds = $pdf->DefineTitleAligns(count($colTitleSelecteds));
            $gruposSeleccionadosActuales = $pdf->DefineDefaultValuesForGroups($groups);

            $pdf->generalConfigForAllColumns = $generalConfigForAllColumns;
            $pdf->colTitleSelecteds = $colTitleSelecteds;
            $pdf->widthsSelecteds = $widthsSelecteds;
            $pdf->alignSelecteds = $alignSelecteds;
            $pdf->totalAlignSelecteds = $alignSelecteds;
            $pdf->alignTitleSelecteds = $alignTitleSelecteds;
            $pdf->totalAlignTitleSelecteds = $alignTitleSelecteds;
            if ($pdf->debug == 1) {
                echo "<p>^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^Rango Fecha^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^";
                echo $fechaIni."<->".$fechaFin;
                echo "<p>^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^";
                echo "<p>::::::::::::::::::::::::::::::::::::::::::::TOTAL COLUMNAS::::::::::::::::::::::::::::::::::::::::::(".count($columns).")<p>";
                print_r($columns);
                echo "<p>::::::::::::::::::::::::::::::::::::::::::::FILTROS::::::::::::::::::::::::::::::::::::::::::(".count($filtros).")<p>";
                print_r($filtros);
                echo "<p>::::::::::::::::::::::::::::::::::::::::::::GRUPOS::::::::::::::::::::::::::::::::::::::::::::<p>";
                echo "<p>" . $groups;
                echo "<p>::::::::::::::::::::::::::::::::::::::::::::ORDEN::::::::::::::::::::::::::::::::::::::::::::<p>";
                print_r($sorteds);
                echo "<p>:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::<p>";
            }
            $where = '';
            $yaConsiderados = array();
            for ($k = 0; $k < count($filtros); $k++) {
                $cant = $this->obtieneCantidadVecesConsideracionPorColumnaEnFiltros($filtros[$k]['columna'], $filtros);
                $arr_val = $this->obtieneValoresConsideradosPorColumnaEnFiltros($filtros[$k]['columna'], $filtros);

                for ($j = 0; $j < $n_col; $j++) {
                    if ($sub_keys[$j] == $filtros[$k]['columna']) {
                        $col_fil = $columns[$sub_keys[$j]]['text'];
                    }
                }
                if ($filtros[$k]['tipo'] == 'datefilter') {
                    $filtros[$k]['valor'] = date("Y-m-d", strtotime($filtros[$k]['valor']));
                }
                $cond_fil = ' ' . $col_fil;
                if (!in_array($filtros[$k]['columna'], $yaConsiderados)) {

                    if (strlen($where) > 0) {
                        switch ($filtros[$k]['condicion']) {
                            case 'EMPTY':
                                $where .= ' AND ';
                                break;
                            case 'NOT_EMPTY':
                                $where .= ' AND ';
                                break;
                            case 'CONTAINS':
                                $where .= ' AND ';
                                break;
                            case 'EQUAL':
                                $where .= ' AND ';
                                break;
                            case 'GREATER_THAN_OR_EQUAL':
                                $where .= ' AND ';
                                break;
                            case 'LESS_THAN_OR_EQUAL':
                                $where .= ' AND ';
                                break;
                        }
                    }
                }
                if ($cant > 1) {
                    if ($pdf->debug == 1) {
                        echo "<p>::::::::::::::::::::::::::::::::::::YA CONSIDERADOS:::::::::::::::::::::::::::::::::::::::::::::::<p>";
                        print_r($yaConsiderados);
                        echo "<p>::::::::::::::::::::::::::::::::::::YA CONSIDERADOS:::::::::::::::::::::::::::::::::::::::::::::::<p>";
                    }
                    if (!in_array($filtros[$k]['columna'], $yaConsiderados)) {
                        switch ($filtros[$k]['condicion']) {
                            case 'EMPTY':
                                $cond_fil .= utf8_encode(" que sea vacía ");
                                $where .= "(" . $filtros[$k]['columna'] . " IS NULL OR " . $filtros[$k]['columna'] . " ILIKE '')";
                                break;
                            case 'NOT_EMPTY':
                                $cond_fil .= utf8_encode(" que no sea vacía ");
                                $where .= "(" . $filtros[$k]['columna'] . " IS NOT NULL OR " . $filtros[$k]['columna'] . " NOT ILIKE '')";
                                break;
                            case 'CONTAINS':
                                $cond_fil .= utf8_encode(" que contenga el valor:  " . $filtros[$k]['valor']);
                                if ($filtros[$k]['columna'] == "nombres") {
                                    $where .= "(p_nombre ILIKE '%" . $filtros[$k]['valor'] . "%' OR s_nombre ILIKE '%" . $filtros[$k]['valor'] . "%' OR t_nombre ILIKE '%" . $filtros[$k]['valor'] . "%' OR p_apellido ILIKE '%" . $filtros[$k]['valor'] . "%' OR s_apellido ILIKE '%" . $filtros[$k]['valor'] . "%' OR c_apellido ILIKE '%" . $filtros[$k]['valor'] . "%')";
                                } else {
                                    $where .= $filtros[$k]['columna'] . " ILIKE '%" . $filtros[$k]['valor'] . "%'";
                                }
                                break;
                            case 'EQUAL':
                                $cond_fil .= utf8_encode(" que contenga el valor:  " . $filtros[$k]['valor']);
                                $ini = 0;
                                foreach ($arr_val as $col) {
                                    if ($pdf->debug == 1) {

                                        echo "<p>.........................recorriendo las columnas multiseleccionadas: .............................................";
                                        echo $filtros[$k]['columna'] . "-->" . $col;
                                        echo "<p>.........................recorriendo las columnas multiseleccionadas: .............................................";
                                    }
                                    if (isset($generalConfigForAllColumns[$filtros[$k]['columna']]['type'])) {
                                        //$where .= $filtros[$k]['columna']." ILIKE '".$filtros[$k]['valor']."'";
                                        if ($ini == 0) {
                                            $where .= " (";
                                        }
                                        switch (@$generalConfigForAllColumns[$filtros[$k]['columna']]['type']) {
                                            case 'int4':
                                            case 'numeric':
                                            case 'date':
                                                //$whereEqueals .= $filtros[$k]['columna']." = '".$filtros[$k]['valor']."'";
                                                $where .= $filtros[$k]['columna'] . " = '" . $col . "'";
                                                break;
                                            case 'varchar':
                                            case 'bpchar':
                                                //$whereEqueals .= $filtros[$k]['columna']." ILIKE '".$filtros[$k]['valor']."'";
                                                $where .= $filtros[$k]['columna'] . " ILIKE '" . $col . "'";
                                                break;
                                        }
                                        $ini++;
                                        if ($ini == count($arr_val)) {
                                            $where .= ") ";
                                        } else $where .= " OR ";
                                    }
                                }
                                break;
                            case 'GREATER_THAN_OR_EQUAL':
                                $cond_fil .= utf8_encode(" que sea mayor o igual que:  " . $filtros[$k]['valor']);
                                $ini = 0;
                                foreach ($arr_val as $col) {
                                    //$fecha = date("Y-m-d", $col);
                                    $fecha = $col;
                                    if (isset($generalConfigForAllColumns[$filtros[$k]['columna']]['type'])) {
                                        //$where .= $filtros[$k]['columna']." ILIKE '".$filtros[$k]['valor']."'";
                                        if ($ini == 0) {
                                            $where .= " (";
                                        }
                                        switch (@$generalConfigForAllColumns[$filtros[$k]['columna']]['type']) {
                                            case 'int4':
                                            case 'numeric':
                                                $where .= $filtros[$k]['columna'] . " = '" . $fecha . "'";
                                                break;
                                            case 'date':
                                                //$whereEqueals .= $filtros[$k]['columna']." = '".$filtros[$k]['valor']."'";
                                                if ($ini == 0) {
                                                    $where .= $filtros[$k]['columna'] . " BETWEEN ";
                                                } else {
                                                    $where .= " AND ";
                                                }
                                                $where .= "'" . $fecha . "'";

                                                break;
                                            case 'varchar':
                                            case 'bpchar':
                                                //$whereEqueals .= $filtros[$k]['columna']." ILIKE '".$filtros[$k]['valor']."'";
                                                $where .= $filtros[$k]['columna'] . " ILIKE '" . $col . "'";
                                                break;
                                        }
                                        $ini++;
                                        if ($ini == count($arr_val)) {
                                            $where .= ") ";
                                        }
                                    }
                                }
                                break;
                            case 'LESS_THAN_OR_EQUAL':
                                $cond_fil .= utf8_encode(" que sea menor o igual que:  " . $filtros[$k]['valor']);
                                $where .= $filtros[$k]['columna'] . ' <= "' . $filtros[$k]['valor'] . '"';
                                break;
                        }
                        $yaConsiderados[] = $filtros[$k]['columna'];
                    }
                } else {
                    switch ($filtros[$k]['condicion']) {
                        case 'EMPTY':
                            $cond_fil .= utf8_encode(" que sea vacía ");
                            $where .= "(" . $filtros[$k]['columna'] . " IS NULL OR " . $filtros[$k]['columna'] . " ILIKE '')";
                            break;
                        case 'NOT_EMPTY':
                            $cond_fil .= utf8_encode(" que no sea vacía ");
                            $where .= "(" . $filtros[$k]['columna'] . " IS NOT NULL OR " . $filtros[$k]['columna'] . " NOT ILIKE '')";
                            break;
                        case 'CONTAINS':
                            $cond_fil .= utf8_encode(" que contenga el valor:  " . $filtros[$k]['valor']);
                            if ($filtros[$k]['columna'] == "nombres") {
                                $where .= "(p_nombre ILIKE '%" . $filtros[$k]['valor'] . "%' OR s_nombre ILIKE '%" . $filtros[$k]['valor'] . "%' OR t_nombre ILIKE '%" . $filtros[$k]['valor'] . "%' OR p_apellido ILIKE '%" . $filtros[$k]['valor'] . "%' OR s_apellido ILIKE '%" . $filtros[$k]['valor'] . "%' OR c_apellido ILIKE '%" . $filtros[$k]['valor'] . "%')";
                            } else {
                                $where .= $filtros[$k]['columna'] . " ILIKE '%" . $filtros[$k]['valor'] . "%'";
                            }
                            break;
                        case 'EQUAL':
                            $cond_fil .= utf8_encode(" que contenga el valor:  " . $filtros[$k]['valor']);
                            if (isset($generalConfigForAllColumns[$filtros[$k]['columna']]['type'])) {
                                //$where .= $filtros[$k]['columna']." ILIKE '".$filtros[$k]['valor']."'";
                                switch (@$generalConfigForAllColumns[$filtros[$k]['columna']]['type']) {
                                    case 'int4':
                                    case 'numeric':
                                    case 'date':
                                        //$whereEqueals .= $filtros[$k]['columna']." = '".$filtros[$k]['valor']."'";
                                        $where .= $filtros[$k]['columna'] . " = '" . $filtros[$k]['valor'] . "'";
                                        break;
                                    case 'varchar':
                                    case 'bpchar':
                                        //$whereEqueals .= $filtros[$k]['columna']." ILIKE '".$filtros[$k]['valor']."'";
                                        $where .= $filtros[$k]['columna'] . " ILIKE '" . $filtros[$k]['valor'] . "'";
                                        break;
                                }
                            }
                            break;
                        case 'GREATER_THAN_OR_EQUAL':
                            $cond_fil .= utf8_encode(" que sea mayor o igual que:  " . $filtros[$k]['valor']);
                            $where .= $filtros[$k]['columna'] . ' >= "' . $filtros[$k]['valor'] . '"';
                            break;
                        case 'LESS_THAN_OR_EQUAL':
                            $cond_fil .= utf8_encode(" que sea menor o igual que:  " . $filtros[$k]['valor']);
                            $where .= $filtros[$k]['columna'] . ' <= "' . $filtros[$k]['valor'] . '"';
                            break;
                    }
                }

            }
            $obj = new Frelaboraleshorariosymarcaciones();
            if ($where != "") $where = " WHERE " . $where;
            $groups_aux = "";
            if ($groups != "") {
                /**
                 * Se verifica que no se considere la columna nombres debido a que contenido ya esta ordenado por las
                 * columnas p_apellido, s_apellido, c_apellido, p_anombre, s_nombre, t_nombre
                 */
                if (strrpos($groups, "nombres")) {
                    if (strrpos($groups, ",")) {
                        $arr = explode(",", $groups);
                        foreach ($arr as $val) {
                            if ($val != "nombres")
                                $groups_aux[] = $val;
                        }
                        $groups = implode(",", $groups_aux);
                    } else $groups = "";
                }
                if (is_array($sorteds) && count($sorteds) > 0) {
                    if ($groups != "") $groups .= ",";
                    $coma = "";
                    if ($pdf->debug == 1) {
                        echo "<p>===========================================Orden======================================</p>";
                        print_r($sorteds);
                        echo "<p>===========================================Orden======================================</p>";
                    }
                    foreach ($sorteds as $ord => $orden) {
                        $groups .= $coma . $ord;
                        if ($orden['asc'] == '') $groups .= " ASC"; else$groups .= " DESC";
                        $coma = ",";
                    }
                }
                if ($groups != "")
                    $groups = " ORDER BY " . $groups . ",relaboral_id,gestion,mes,turno,modalidadmarcacion_id";
                if ($pdf->debug == 1) echo "<p>La consulta es: " . $groups . "<p>";
            } else {
                if (is_array($sorteds) && count($sorteds) > 0) {
                    $coma = "";
                    if ($pdf->debug == 1) {
                        echo "<p>===========================================Orden======================================</p>";
                        print_r($sorteds);
                        echo "<p>===========================================Orden======================================</p>";
                    }
                    foreach ($sorteds as $ord => $orden) {
                        $groups .= $coma . $ord;
                        if ($orden['asc'] == '') $groups .= " ASC"; else$groups .= " DESC";
                        $coma = ",";
                    }
                    $groups = " ORDER BY " . $groups;
                }

            }
            if($ci!=''){
                if($where!='')$where.=" AND ci='".$ci."'";
                else $where.=" WHERE ci='".$ci."'";
            }
            if ($pdf->debug == 1) echo "<p>WHERE------------------------->" . $where . "<p>";
            if ($pdf->debug == 1) echo "<p>GROUP BY------------------------->" . $groups . "<p>";
            $resul = $obj->getAllByRangeTwoMonth(0,$fechaIni,$fechaFin,$where,$groups);

            $arrTotales = array();
            $horariosymarcaciones = array();
            $totalAtrasos = $totalFaltas = $totalAbandono = $totalOmision = $totalLsgh = $totalCompensacion = 0;

            foreach ($resul as $v) {
                $horariosymarcaciones[] = array(
                    #region Columnas de procedimiento f_relaborales()
                    'id_relaboral' => $v->id_relaboral,
                    'id_persona' => $v->id_persona,
                    'p_nombre' => $v->p_nombre,
                    's_nombre' => $v->s_nombre,
                    't_nombre' => $v->t_nombre,
                    'p_apellido' => $v->p_apellido,
                    's_apellido' => $v->s_apellido,
                    'c_apellido' => $v->c_apellido,
                    'nombres' => $v->nombres,
                    'ci' => $v->ci,
                    'expd' => $v->expd,
                    'cargo' => $v->cargo,
                    'sueldo' => str_replace(".00", "", $v->sueldo),
                    'condicion' => $v->condicion,
                    'gerencia_administrativa' => $v->gerencia_administrativa,
                    'departamento_administrativo' => $v->departamento_administrativo,
                    'area' => $v->area,
                    'ubicacion' => $v->ubicacion,
                    #endregion Columnas de procedimiento f_relaborales()

                    'id'=>$v->id_horarioymarcacion,
                    'relaboral_id'=>$v->relaboral_id,
                    'gestion'=>$v->gestion,
                    'mes'=>$v->mes,
                    'mes_nombre'=>$v->mes_nombre,
                    'turno'=>$v->turno,
                    'grupo'=>$v->grupo,
                    'clasemarcacion'=>$v->clasemarcacion,
                    'clasemarcacion_descripcion'=>$v->clasemarcacion_descripcion,
                    'modalidadmarcacion_id'=>$v->modalidadmarcacion_id,
                    'modalidad_marcacion'=>$v->modalidad_marcacion,
                    'd1'=>$v->d1,
                    'calendariolaboral1_id'=>$v->calendariolaboral1_id,
                    'd2'=>$v->d2,
                    'calendariolaboral2_id'=>$v->calendariolaboral2_id,
                    'd3'=>$v->d3,
                    'calendariolaboral3_id'=>$v->calendariolaboral3_id,
                    'd4'=>$v->d4,
                    'calendariolaboral4_id'=>$v->calendariolaboral4_id,
                    'd5'=>$v->d5,
                    'calendariolaboral5_id'=>$v->calendariolaboral5_id,
                    'd6'=>$v->d6,
                    'calendariolaboral6_id'=>$v->calendariolaboral6_id,
                    'd7'=>$v->d7,
                    'calendariolaboral7_id'=>$v->calendariolaboral7_id,
                    'd8'=>$v->d8,
                    'calendariolaboral8_id'=>$v->calendariolaboral8_id,
                    'd9'=>$v->d9,
                    'calendariolaboral9_id'=>$v->calendariolaboral9_id,
                    'd10'=>$v->d10,
                    'calendariolaboral10_id'=>$v->calendariolaboral10_id,
                    'd11'=>$v->d11,
                    'calendariolaboral11_id'=>$v->calendariolaboral11_id,
                    'd12'=>$v->d12,
                    'calendariolaboral12_id'=>$v->calendariolaboral12_id,
                    'd13'=>$v->d13,
                    'calendariolaboral13_id'=>$v->calendariolaboral13_id,
                    'd14'=>$v->d14,
                    'calendariolaboral14_id'=>$v->calendariolaboral14_id,
                    'd15'=>$v->d15,
                    'calendariolaboral15_id'=>$v->calendariolaboral15_id,
                    'd16'=>$v->d16,
                    'calendariolaboral16_id'=>$v->calendariolaboral16_id,
                    'd17'=>$v->d17,
                    'calendariolaboral17_id'=>$v->calendariolaboral17_id,
                    'd18'=>$v->d18,
                    'calendariolaboral18_id'=>$v->calendariolaboral18_id,
                    'd19'=>$v->d19,
                    'calendariolaboral19_id'=>$v->calendariolaboral19_id,
                    'd20'=>$v->d20,
                    'calendariolaboral20_id'=>$v->calendariolaboral20_id,
                    'd21'=>$v->d21,
                    'calendariolaboral21_id'=>$v->calendariolaboral21_id,
                    'd22'=>$v->d22,
                    'calendariolaboral22_id'=>$v->calendariolaboral22_id,
                    'd23'=>$v->d23,
                    'calendariolaboral23_id'=>$v->calendariolaboral23_id,
                    'd24'=>$v->d24,
                    'calendariolaboral24_id'=>$v->calendariolaboral24_id,
                    'd25'=>$v->d25,
                    'calendariolaboral25_id'=>$v->calendariolaboral25_id,
                    'd26'=>$v->d26,
                    'calendariolaboral26_id'=>$v->calendariolaboral26_id,
                    'd27'=>$v->d27,
                    'calendariolaboral27_id'=>$v->calendariolaboral27_id,
                    'd28'=>$v->d28,
                    'calendariolaboral28_id'=>$v->calendariolaboral28_id,
                    'd29'=>$v->d29,
                    'calendariolaboral29_id'=>$v->calendariolaboral29_id,
                    'd30'=>$v->d30,
                    'calendariolaboral30_id'=>$v->calendariolaboral30_id,
                    'd31'=>$v->d31,
                    'calendariolaboral31_id'=>$v->calendariolaboral31_id,
                    'ultimo_dia'=>$v->ultimo_dia,
                    'atrasos'=>$v->atrasos,
                    'faltas'=>$v->faltas,
                    'abandono'=>$v->abandono,
                    'omision'=>$v->omision,
                    'lsgh'=>$v->lsgh,
                    'compensacion'=>$v->compensacion,
                    'estado'=>$v->estado,
                    'estado_descripcion'=>$v->estado_descripcion,
                    'baja_logica'=>$v->baja_logica,
                    'agrupador'=>$v->agrupador,
                    'user_reg_id'=>$v->user_reg_id,
                    'fecha_reg'=>$v->fecha_reg,
                    'user_apr_id'=>$v->user_apr_id,
                    'fecha_apr'=>$v->fecha_apr,
                    'user_mod_id'=>$v->user_mod_id,
                    'fecha_mod'=>$v->fecha_mod,
                );
                #region Sector para almacenamiento de los totales
                if($v->modalidadmarcacion_id==3||$v->modalidadmarcacion_id==6){
                    $atrasos = $faltas = $abandono = $omision = $lsgh = $compensacion = 0;
                    if($v->atrasos!=''){
                        $atrasos=$v->atrasos;
                    }
                    if($v->faltas!=''){
                        $faltas=$v->faltas;
                    }
                    if($v->abandono!=''){
                        $abandono=$v->abandono;
                    }
                    if($v->omision!=''){
                        $omision=$v->omision;
                    }
                    if($v->lsgh!=''){
                        $lsgh=$v->lsgh;
                    }
                    if($v->compensacion!=''){
                        $compensacion=$v->compensacion;
                    }
                    $totalAtrasos += $atrasos;
                    $totalFaltas += $faltas;
                    $totalAbandono += $abandono;
                    $totalOmision += $omision;
                    $totalLsgh += $lsgh;
                    $totalCompensacion += $compensacion;

                    $arrTotales[$v->relaboral_id][$v->gestion][$v->mes]["id_relaboral"]=$v->relaboral_id;
                    $arrTotales[$v->relaboral_id][$v->gestion][$v->mes]["nombres"]=$v->nombres;
                    $arrTotales[$v->relaboral_id][$v->gestion][$v->mes]["ci"]=$v->ci;
                    $arrTotales[$v->relaboral_id][$v->gestion][$v->mes]["expd"]=$v->expd;
                    $arrTotales[$v->relaboral_id][$v->gestion][$v->mes]["gestion"]=$v->gestion;
                    $arrTotales[$v->relaboral_id][$v->gestion][$v->mes]["mes"]=$v->mes;
                    $arrTotales[$v->relaboral_id][$v->gestion][$v->mes]["mes_nombre"]=$v->mes_nombre;
                    $arrTotales[$v->relaboral_id][$v->gestion][$v->mes]["condicion"]=$v->condicion;
                    $arrTotales[$v->relaboral_id][$v->gestion][$v->mes]["gerencia_administrativa"]=$v->gerencia_administrativa;
                    $arrTotales[$v->relaboral_id][$v->gestion][$v->mes]["departamento_administrativo"]=$v->departamento_administrativo;
                    $arrTotales[$v->relaboral_id][$v->gestion][$v->mes]["area"]=$v->area;
                    $arrTotales[$v->relaboral_id][$v->gestion][$v->mes]["ubicacion"]=$v->ubicacion;
                    $arrTotales[$v->relaboral_id][$v->gestion][$v->mes]["sueldo"]=$v->sueldo;
                    $arrTotales[$v->relaboral_id][$v->gestion][$v->mes]["cargo"]=$v->cargo;
                    /*echo "<p>---------------------------------------------------------------------</p>";
                    echo "1) ".$atrasos.", 2) ".$faltas.", 3) ".$abandono.", 4) ".$omision.", 5) ".$lsgh.", 6) ".$compensacion;
                    echo "<p>---------------------------------------------------------------------</p>";*/
                    if(isset($arrTotales[$v->relaboral_id][$v->gestion][$v->mes]["atrasos"])&&$arrTotales[$v->relaboral_id][$v->gestion][$v->mes]["atrasos"]>0){
                        $arrTotales[$v->relaboral_id][$v->gestion][$v->mes]["atrasos"] = $arrTotales[$v->relaboral_id][$v->gestion][$v->mes]["atrasos"] + $atrasos;
                    }else{
                        $arrTotales[$v->relaboral_id][$v->gestion][$v->mes]["atrasos"] = $atrasos;
                    }
                    if(isset($arrTotales[$v->relaboral_id][$v->gestion][$v->mes]["faltas"])&&$arrTotales[$v->relaboral_id][$v->gestion][$v->mes]["faltas"]>0){
                        $arrTotales[$v->relaboral_id][$v->gestion][$v->mes]["faltas"] = $arrTotales[$v->relaboral_id][$v->gestion][$v->mes]["faltas"] + $faltas;
                    }else{
                        $arrTotales[$v->relaboral_id][$v->gestion][$v->mes]["faltas"] = $faltas;
                    }
                    if(isset($arrTotales[$v->relaboral_id][$v->gestion][$v->mes]["abandono"])&&$arrTotales[$v->relaboral_id][$v->gestion][$v->mes]["abandono"]>0){
                        $arrTotales[$v->relaboral_id][$v->gestion][$v->mes]["abandono"] = $arrTotales[$v->relaboral_id][$v->gestion][$v->mes]["abandono"] + $abandono;
                    }else{
                        $arrTotales[$v->relaboral_id][$v->gestion][$v->mes]["abandono"] = $abandono;
                    }
                    if(isset($arrTotales[$v->relaboral_id][$v->gestion][$v->mes]["omision"])&&$arrTotales[$v->relaboral_id][$v->gestion][$v->mes]["omision"]>0){
                        $arrTotales[$v->relaboral_id][$v->gestion][$v->mes]["omision"] = $arrTotales[$v->relaboral_id][$v->gestion][$v->mes]["omision"] + $omision;
                    }else{
                        $arrTotales[$v->relaboral_id][$v->gestion][$v->mes]["omision"] = $omision;
                    }
                    if(isset($arrTotales[$v->relaboral_id][$v->gestion][$v->mes]["lsgh"])&&$arrTotales[$v->relaboral_id][$v->gestion][$v->mes]["lsgh"]>0){
                        $arrTotales[$v->relaboral_id][$v->gestion][$v->mes]["lsgh"] = $arrTotales[$v->relaboral_id][$v->gestion][$v->mes]["lsgh"] + $lsgh;
                    }else{
                        $arrTotales[$v->relaboral_id][$v->gestion][$v->mes]["lsgh"] = $lsgh;
                    }
                    if(isset($arrTotales[$v->relaboral_id][$v->gestion][$v->mes]["compensacion"])&&$arrTotales[$v->relaboral_id][$v->gestion][$v->mes]["compensacion"]>0){
                        $arrTotales[$v->relaboral_id][$v->gestion][$v->mes]["compensacion"] = $arrTotales[$v->relaboral_id][$v->gestion][$v->mes]["compensacion"] + $compensacion;
                    }else{
                        $arrTotales[$v->relaboral_id][$v->gestion][$v->mes]["compensacion"] = $compensacion;
                    }
                }
                #endregion Sector para almacenamiento de los totales
                #region Sector para adicionar una fila para Excepciones
                if($v->modalidadmarcacion_id==6){
                    $d1=$d2=$d3=$d4=$d5=$d6=$d7=$d8=$d9=$d10=$d11=$d12=$d13=$d14=$d15=$d16=$d17=$d18=$d19=$d20=$d21=$d22=$d23=$d24=$d25=$d26=$d27=$d28=$d29=$d30=$d30=$d31="";
                    if($v->calendariolaboral1_id>0){
                        $res1 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,1,$v->calendariolaboral1_id);
                        if(is_object($res1)&&$res1->count()>0){
                            foreach($res1 as $r1){
                                $d1 = $r1->f_excepciones_en_dia;
                            }
                        }
                    }
                    if($v->calendariolaboral2_id>0){
                        $res2 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,2,$v->calendariolaboral2_id,1);
                        if(is_object($res2)&&$res2->count()>0){
                            foreach($res2 as $r2){
                                $d2 = $r2->f_excepciones_en_dia;
                            }
                        }
                    }
                    if($v->calendariolaboral3_id>0){
                        $res3 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,3,$v->calendariolaboral3_id,1);
                        if(is_object($res3)&&$res3->count()>0){
                            foreach($res3 as $r3){
                                $d3 = $r3->f_excepciones_en_dia;
                            }
                        }
                    }

                    if($v->calendariolaboral4_id>0){
                        $res4 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,4,$v->calendariolaboral4_id,1);
                        if(is_object($res4)&&$res4->count()>0){
                            foreach($res4 as $r4){
                                $d4 = $r4->f_excepciones_en_dia;
                            }
                        }
                    }
                    if($v->calendariolaboral5_id>0){
                        $res5 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,5,$v->calendariolaboral5_id,1);
                        if(is_object($res5)&&$res5->count()>0){
                            foreach($res5 as $r5){
                                $d5 = $r5->f_excepciones_en_dia;
                            }
                        }
                    }
                    if($v->calendariolaboral6_id>0){
                        $res6 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,6,$v->calendariolaboral6_id,1);
                        if(is_object($res6)&&$res6->count()>0){
                            foreach($res6 as $r6){
                                $d6 = $r6->f_excepciones_en_dia;
                            }
                        }
                    }
                    if($v->calendariolaboral7_id>0){
                        $res7 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,7,$v->calendariolaboral7_id,1);
                        if(is_object($res7)&&$res7->count()>0){
                            foreach($res7 as $r7){
                                $d7 = $r7->f_excepciones_en_dia;
                            }
                        }
                    }
                    if($v->calendariolaboral8_id>0){
                        $res8 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,8,$v->calendariolaboral8_id,1);
                        if(is_object($res8)&&$res8->count()>0){
                            foreach($res8 as $r8){
                                $d8 = $r8->f_excepciones_en_dia;
                            }
                        }
                    }
                    if($v->calendariolaboral9_id>0){
                        $res9 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,9,$v->calendariolaboral9_id,1);
                        if(is_object($res9)&&$res9->count()>0){
                            foreach($res9 as $r9){
                                $d9 = $r9->f_excepciones_en_dia;
                            }
                        }
                    }
                    if($v->calendariolaboral10_id>0){
                        $res10 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,10,$v->calendariolaboral10_id,1);
                        if(is_object($res10)&&$res10->count()>0){
                            foreach($res10 as $r10){
                                $d10 = $r10->f_excepciones_en_dia;
                            }
                        }
                    }
                    if($v->calendariolaboral11_id>0){
                        $res11 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,11,$v->calendariolaboral11_id,1);
                        if(is_object($res11)&&$res11->count()>0){
                            foreach($res11 as $r11){
                                $d11 = $r11->f_excepciones_en_dia;
                            }
                        }
                    }
                    if($v->calendariolaboral12_id>0){
                        $res12 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,12,$v->calendariolaboral12_id,1);
                        if(is_object($res12)&&$res12->count()>0){
                            foreach($res12 as $r12){
                                $d12 = $r12->f_excepciones_en_dia;
                            }
                        }
                    }

                    if($v->calendariolaboral13_id>0){
                        $res13 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,13,$v->calendariolaboral13_id,1);
                        if(is_object($res13)&&$res13->count()>0){
                            foreach($res13 as $r13){
                                $d13 = $r13->f_excepciones_en_dia;
                            }
                        }
                    }

                    if($v->calendariolaboral14_id>0){
                        $res14 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,14,$v->calendariolaboral14_id,1);
                        if(is_object($res14)&&$res14->count()>0){
                            foreach($res14 as $r14){
                                $d14 = $r14->f_excepciones_en_dia;
                            }
                        }
                    }
                    if($v->calendariolaboral15_id>0){
                        $res15 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,15,$v->calendariolaboral15_id,1);
                        if(is_object($res15)&&$res15->count()>0){
                            foreach($res15 as $r15){
                                $d15 = $r15->f_excepciones_en_dia;
                            }
                        }
                    }
                    if($v->calendariolaboral16_id>0){
                        $res16 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,16,$v->calendariolaboral16_id,1);
                        if(is_object($res16)&&$res16->count()>0){
                            foreach($res16 as $r16){
                                $d16 = $r16->f_excepciones_en_dia;
                            }
                        }
                    }
                    if($v->calendariolaboral17_id>0){
                        $res17 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,17,$v->calendariolaboral17_id,1);
                        if(is_object($res17)&&$res17->count()>0){
                            foreach($res17 as $r17){
                                $d17 = $r17->f_excepciones_en_dia;
                            }
                        }
                    }
                    if($v->calendariolaboral18_id>0){
                        $res18 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,18,$v->calendariolaboral18_id,1);
                        if(is_object($res18)&&$res18->count()>0){
                            foreach($res18 as $r){
                                $d18 = $r->f_excepciones_en_dia;
                            }
                        }
                    }
                    if($v->calendariolaboral19_id>0){
                        $res19 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,19,$v->calendariolaboral19_id,1);
                        if(is_object($res19)&&$res19->count()>0){
                            foreach($res19 as $r){
                                $d19 = $r->f_excepciones_en_dia;
                            }
                        }
                    }
                    if($v->calendariolaboral20_id>0){
                        $res20 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,20,$v->calendariolaboral20_id,1);
                        if(is_object($res20)&&$res20->count()>0){
                            foreach($res20 as $r){
                                $d20 = $r->f_excepciones_en_dia;
                            }
                        }
                    }
                    if($v->calendariolaboral21_id>0){
                        $res21 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,21,$v->calendariolaboral21_id,1);
                        if(is_object($res21)&&$res21->count()>0){
                            foreach($res21 as $r21){
                                $d21 = $r21->f_excepciones_en_dia;
                            }
                        }
                    }
                    if($v->calendariolaboral22_id>0){
                        $res22 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,22,$v->calendariolaboral22_id,1);
                        if(is_object($res22)&&$res22->count()>0){
                            foreach($res22 as $r22){
                                $d22 = $r22->f_excepciones_en_dia;
                            }
                        }
                    }
                    if($v->calendariolaboral23_id>0){
                        $res23 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,23,$v->calendariolaboral23_id,1);
                        if(is_object($res23)&&$res23->count()>0){
                            foreach($res23 as $r23){
                                $d23 = $r23->f_excepciones_en_dia;
                            }
                        }
                    }
                    if($v->calendariolaboral24_id>0){
                        $res24 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,24,$v->calendariolaboral24_id,1);
                        if(is_object($res24)&&$res24->count()>0){
                            foreach($res24 as $r24){
                                $d24 = $r24->f_excepciones_en_dia;
                            }
                        }
                    }
                    if($v->calendariolaboral25_id>0){
                        $res25 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,25,$v->calendariolaboral25_id,1);
                        if(is_object($res25)&&$res25->count()>0){
                            foreach($res25 as $r25){
                                $d25 = $r25->f_excepciones_en_dia;
                            }
                        }
                    }
                    if($v->calendariolaboral26_id>0){
                        $res26 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,26,$v->calendariolaboral26_id,1);
                        if(is_object($res26)&&$res26->count()>0){
                            foreach($res26 as $r26){
                                $d26 = $r26->f_excepciones_en_dia;
                            }
                        }
                    }
                    if($v->calendariolaboral27_id>0){
                        $res27 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,27,$v->calendariolaboral27_id,1);
                        if(is_object($res27)&&$res27->count()>0){
                            foreach($res27 as $r27){
                                $d27 = $r27->f_excepciones_en_dia;
                            }

                        }
                    }
                    if($v->calendariolaboral28_id>0){
                        $res28 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,28,$v->calendariolaboral28_id,1);
                        if(is_object($res28)&&$res28->count()>0){
                            foreach($res28 as $r28){
                                $d28 = $r28->f_excepciones_en_dia;
                            }
                        }
                    }
                    if($v->calendariolaboral29_id>0){
                        $res29 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,29,$v->calendariolaboral29_id,1);
                        if(is_object($res29)&&$res29->count()>0){
                            foreach($res29 as $r29){
                                $d29 = $r29->f_excepciones_en_dia;
                            }
                        }
                    }
                    if($v->calendariolaboral30_id>0){
                        $res30 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,30,$v->calendariolaboral30_id,1);
                        if(is_object($res30)&&$res30->count()>0){
                            foreach($res30 as $r30){
                                $d30 = $r30->f_excepciones_en_dia;
                            }

                        }
                    }
                    if($v->calendariolaboral31_id>0){
                        $res31 = $obj->getExcepcionEnDia($v->relaboral_id,0,$v->gestion,$v->mes,31,$v->calendariolaboral31_id,1);
                        if(is_object($res31)&&$res31->count()>0){
                            foreach($res31 as $r31){
                                $d31 = $r31->f_excepciones_en_dia;
                            }
                        }
                    }
                    $horariosymarcaciones[] = array(
                        #region Columnas de procedimiento f_relaborales()
                        'id_relaboral' => $v->id_relaboral,
                        'id_persona' => $v->id_persona,
                        'p_nombre' => $v->p_nombre,
                        's_nombre' => $v->s_nombre,
                        't_nombre' => $v->t_nombre,
                        'p_apellido' => $v->p_apellido,
                        's_apellido' => $v->s_apellido,
                        'c_apellido' => $v->c_apellido,
                        'nombres' => $v->nombres,
                        'ci' => $v->ci,
                        'expd' => $v->expd,
                        'cargo' => $v->cargo,
                        'sueldo' => str_replace(".00", "", $v->sueldo),
                        'condicion' => $v->condicion,
                        'gerencia_administrativa' => $v->gerencia_administrativa,
                        'departamento_administrativo' => $v->departamento_administrativo,
                        'area' => $v->area,
                        'ubicacion' => $v->ubicacion,
                        #endregion Columnas de procedimiento f_relaborales()

                        'id'=>$v->id_horarioymarcacion,
                        'relaboral_id'=>$v->relaboral_id,
                        'gestion'=>$v->gestion,
                        'mes'=>$v->mes,
                        'mes_nombre'=>$v->mes_nombre,
                        'turno'=>$v->turno,
                        'grupo'=>$v->grupo,
                        'clasemarcacion'=>"e",
                        'clasemarcacion_descripcion'=>"EXCEPCIONES",
                        'modalidadmarcacion_id'=>$v->modalidadmarcacion_id,
                        'modalidad_marcacion'=>"EXCEPCIONES",
                        'd1'=>$d1,
                        'calendariolaboral1_id'=>$v->calendariolaboral1_id,
                        'd2'=>$d2,
                        'calendariolaboral2_id'=>$v->calendariolaboral2_id,
                        'd3'=>$d3,
                        'calendariolaboral3_id'=>$v->calendariolaboral3_id,
                        'd4'=>$d4,
                        'calendariolaboral4_id'=>$v->calendariolaboral4_id,
                        'd5'=>$d5,
                        'calendariolaboral5_id'=>$v->calendariolaboral5_id,
                        'd6'=>$d6,
                        'calendariolaboral6_id'=>$v->calendariolaboral6_id,
                        'd7'=>$d7,
                        'calendariolaboral7_id'=>$v->calendariolaboral7_id,
                        'd8'=>$d8,
                        'calendariolaboral8_id'=>$v->calendariolaboral8_id,
                        'd9'=>$d9,
                        'calendariolaboral9_id'=>$v->calendariolaboral9_id,
                        'd10'=>$d10,
                        'calendariolaboral10_id'=>$v->calendariolaboral10_id,
                        'd11'=>$d11,
                        'calendariolaboral11_id'=>$v->calendariolaboral11_id,
                        'd12'=>$d12,
                        'calendariolaboral12_id'=>$v->calendariolaboral12_id,
                        'd13'=>$d13,
                        'calendariolaboral13_id'=>$v->calendariolaboral13_id,
                        'd14'=>$d14,
                        'calendariolaboral14_id'=>$v->calendariolaboral14_id,
                        'd15'=>$d15,
                        'calendariolaboral15_id'=>$v->calendariolaboral15_id,
                        'd16'=>$d16,
                        'calendariolaboral16_id'=>$v->calendariolaboral16_id,
                        'd17'=>$d17,
                        'calendariolaboral17_id'=>$v->calendariolaboral17_id,
                        'd18'=>$d18,
                        'calendariolaboral18_id'=>$v->calendariolaboral18_id,
                        'd19'=>$d19,
                        'calendariolaboral19_id'=>$v->calendariolaboral19_id,
                        'd20'=>$d20,
                        'calendariolaboral20_id'=>$v->calendariolaboral20_id,
                        'd21'=>$d21,
                        'calendariolaboral21_id'=>$v->calendariolaboral21_id,
                        'd22'=>$d22,
                        'calendariolaboral22_id'=>$v->calendariolaboral22_id,
                        'd23'=>$d23,
                        'calendariolaboral23_id'=>$v->calendariolaboral23_id,
                        'd24'=>$d24,
                        'calendariolaboral24_id'=>$v->calendariolaboral24_id,
                        'd25'=>$d25,
                        'calendariolaboral25_id'=>$v->calendariolaboral25_id,
                        'd26'=>$d26,
                        'calendariolaboral26_id'=>$v->calendariolaboral26_id,
                        'd27'=>$d27,
                        'calendariolaboral27_id'=>$v->calendariolaboral27_id,
                        'd28'=>$d28,
                        'calendariolaboral28_id'=>$v->calendariolaboral28_id,
                        'd29'=>$d29,
                        'calendariolaboral29_id'=>$v->calendariolaboral29_id,
                        'd30'=>$d30,
                        'calendariolaboral30_id'=>$v->calendariolaboral30_id,
                        'd31'=>$d31,
                        'calendariolaboral31_id'=>$v->calendariolaboral31_id,
                        'ultimo_dia'=>$v->ultimo_dia,
                        'atrasos'=>null,
                        'faltas'=>null,
                        'abandono'=>null,
                        'omision'=>null,
                        'lsgh'=>null,
                        'compensacion'=>null,
                        'observacion'=>$v->observacion,
                        'estado'=>$v->estado,
                        'estado_descripcion'=>$v->estado_descripcion,
                        'baja_logica'=>$v->baja_logica,
                        'agrupador'=>$v->agrupador,
                        'user_reg_id'=>$v->user_reg_id,
                        'fecha_reg'=>$v->fecha_reg,
                        'user_apr_id'=>$v->user_apr_id,
                        'fecha_apr'=>$v->fecha_apr,
                        'user_mod_id'=>$v->user_mod_id,
                        'fecha_mod'=>$v->fecha_mod,
                    );
                }
                #endregion sector para adicionar una fila para Excepciones
            }
            //$pdf->Open("L");
            /**
             * Si el ancho supera el establecido para una hoja tamaño carta, se la pone en posición horizontal
             */

            $pdf->AddPage();
            if ($pdf->debug == 1) {
                echo "<p>El ancho es:: " . $ancho;
            }
            #region Espacio para la definición de valores para la cabecera de la tabla
            $pdf->FechaHoraReporte = date("d-m-Y H:i:s");
            $j = 0;
            $agrupadores = array();

            if ($groups != "")
                $agrupadores = explode(",", $groups);

            $dondeCambio = array();
            $queCambio = array();

            if (count($horariosymarcaciones) > 0){
                foreach ($horariosymarcaciones as $i => $val) {
                    if (($pdf->pageWidth - $pdf->tableWidth) > 0) $pdf->SetX(($pdf->pageWidth - $pdf->tableWidth) / 2);
                    if (count($agrupadores) > 0) {
                        if ($pdf->debug == 1) {
                            echo "<p>|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||<p></p>";
                            print_r($gruposSeleccionadosActuales);
                            echo "<p>|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||<p></p>";
                        }
                        $agregarAgrupador = 0;
                        $aux = array();
                        $dondeCambio = array();
                        foreach ($gruposSeleccionadosActuales as $key => $valor) {
                            if ($valor != $val[$key]) {
                                $agregarAgrupador = 1;
                                $aux[$key] = $val[$key];
                                $dondeCambio[] = $key;
                                $queCambio[$key] = $val[$key];
                            } else {
                                $aux[$key] = $val[$key];
                            }
                        }
                        $gruposSeleccionadosActuales = $aux;
                        if ($agregarAgrupador == 1) {
                            $pdf->Ln();
                            $pdf->DefineColorHeaderTable();
                            $pdf->SetAligns($alignTitleSelecteds);
                            //if(($pdf->pageWidth-$pdf->tableWidth)>0)$pdf->SetX(($pdf->pageWidth-$pdf->tableWidth)/2);
                            $agr = $pdf->DefineTitleColsByGroups($generalConfigForAllColumns, $dondeCambio, $queCambio);
                            $pdf->Agrupador($agr);
                            $pdf->RowTitle($colTitleSelecteds);
                        }
                        $pdf->DefineColorBodyTable();
                        $pdf->SetAligns($alignSelecteds);
                        if (($pdf->pageWidth - $pdf->tableWidth) > 0) $pdf->SetX(($pdf->pageWidth - $pdf->tableWidth) / 2);
                        $rowData = $pdf->DefineRows($j + 1, $horariosymarcaciones[$j], $colSelecteds);
                        $pdf->Row($rowData);

                    } else {
                        //if(($pdf->pageWidth-$pdf->tableWidth)>0)$pdf->SetX(($pdf->pageWidth-$pdf->tableWidth)/2);
                        if($pdf->debug==1){
                            echo "<p>***********************************VALOR POR LA LINEA ".($j + 1)."***************************************************</p>";
                            print_r($val);
                            echo "<p>***************************************************************************************</p>";
                        }
                        $pdf->DefineColorBodyTable();
                        $pdf->SetAligns($alignSelecteds);
                        $rowData = $pdf->DefineRows($j + 1, $val, $colSelecteds);
                        $pdf->Row($rowData);
                    }
                    //if(($pdf->pageWidth-$pdf->tableWidth)>0)$pdf->SetX(($pdf->pageWidth-$pdf->tableWidth)/2);
                    $j++;
                }
                #region Espacio para la definición de datos para la grilla de totales
                $totalCols = $pdf->DefineSelectedTotalCols($generalConfigForAllColumns);
                $totalTitleCols = $pdf->DefineTotalTitleCols($generalConfigForAllColumns, $totalCols);
                $totalAligns = $pdf->DefineAlignsForTotals($generalConfigForAllColumns, $totalCols);
                $totalWidths = $this->DefineTotalWidths($generalConfigForAllColumns,$totalCols);
                $anchoT=0;
                foreach ($totalWidths as $w) {
                    $anchoT = $anchoT + $w;
                }
                $pdf->totalColTitleSelecteds = $totalTitleCols;
                $pdf->totalWidths = $totalWidths;
                $pdf->totalAligns = $totalAligns;
                $pdf->totalTableWidth = $anchoT;

                $pdf->agregarPaginaTotales($arrTotales,$totalAtrasos,$totalFaltas,$totalAbandono,$totalOmision,$totalLsgh,$totalCompensacion);
                #endregion Espacio para la definición de datos para la grilla de totales
            }
            $pdf->ShowLeftFooter = true;
            if($pdf->debug==0)$pdf->Output('reporte_marcaciones.pdf','I');
            #endregion Proceso de generación del documento PDF
        }
    }
    /**
     * Función para la generación del array con los anchos de columna definido, en consideración a las columnas mostradas.
     * @param $generalWiths Array de los anchos y alineaciones de columnas disponibles.
     * @param $columns Array de las columnas con las propiedades de oculto (hidden:1) y visible (hidden:null).
     * @return array Array con el listado de anchos por columna a desplegarse.
     */
    function DefineWidths($widthAlignAll,$columns,$exclude=array()){
        $arrRes = Array();
        $arrRes[]=8;
        foreach($columns as $key => $val){
            if(isset($widthAlignAll[$key])){
                if(!isset($val['hidden'])||$val['hidden']!=true){
                    if(!in_array($key,$exclude)||count($exclude)==0)
                        $arrRes[]=$widthAlignAll[$key]['width'];
                }
            }
        }
        return $arrRes;
    }

    /**
     * Función para la obtención del listado de anchos de campo para la grilla de totales.
     * @param $widthAlignAll
     * @param $totalCols
     * @return array
     */
    function DefineTotalWidths($widthAlignAll,$totalCols){
        $arrRes = Array();
        foreach($totalCols as $key => $val){
            if(isset($widthAlignAll[$val])){
                $arrRes[]=$widthAlignAll[$val]['width'];
            }
        }
        return $arrRes;
    }
    /*
     * Función para obtener la cantidad de veces que se considera una misma columna en el filtrado.
     * @param $columna
     * @param $array
     * @return int
     */
    function obtieneCantidadVecesConsideracionPorColumnaEnFiltros($columna, $array)
    {
        $cont = 0;
        if (count($array) >= 1) {
            foreach ($array as $key => $val) {
                if (in_array($columna, $val)) {
                    $cont++;
                }
            }
        }
        return $cont;
    }

    /**
     * Función para la obtención de los valores considerados en el filtro enviado.
     * @param $columna Nombre de la columna
     * @param $array Array con los registro de busquedas.
     * @return array Array con los valores considerados en el filtrado enviado.
     */
    function obtieneValoresConsideradosPorColumnaEnFiltros($columna, $array)
    {
        $arr_col = array();
        $cont = 0;
        if (count($array) >= 1) {
            foreach ($array as $key => $val) {
                if (in_array($columna, $val)) {
                    $arr_col[] = $val["valor"];
                }
            }
        }
        return $arr_col;
    }

    /**
     * Función para la obtención del listado descriptivo de marcaciones.
     */
    function listdescriptivomarcacionesAction(){
        $this->view->disable();
        $horariosymarcacionesgenerados = Array();
        if(isset($_POST["id"])&&$_POST["id"]>0&&isset($_POST["clasemarcacion"])){
            $obj = new Fhorariosymarcacionesgenerados();
            $idRelaboral = $_POST["id"];
            $clasemarcacion = $_POST["clasemarcacion"];
            $resul = $obj->getAll($idRelaboral,0,0,$clasemarcacion);
            //comprobamos si hay filas
            if ($resul->count() > 0) {
                foreach ($resul as $v) {
                    $horariosymarcacionesgenerados[] = array(
                        'nro_row' => 0,
                        'id_relaboral'=>$v->id_relaboral,
                        'id_perfillaboral'=>$v->id_perfillaboral,
                        'perfil_laboral'=>$v->perfil_laboral,
                        'grupo'=>$v->grupo,
                        'perfil_fecha_ini'=>$v->perfil_fecha_ini != "" ? date("d-m-Y", strtotime($v->perfil_fecha_ini)) : "",
                        'perfil_fecha_fin'=>$v->perfil_fecha_fin != "" ? date("d-m-Y", strtotime($v->perfil_fecha_fin)) : "",
                        'gestion'=>$v->gestion,
                        'mes'=>$v->mes,
                        'mes_nombre'=>$v->mes_nombre,
                        'rango_fecha_ini'=>$v->rango_fecha_ini != "" ? date("d-m-Y", strtotime($v->rango_fecha_ini)) : "",
                        'rango_fecha_fin'=>$v->rango_fecha_fin != "" ? date("d-m-Y", strtotime($v->rango_fecha_fin)) : "",
                        'estado'=>$v->estado,
                        'estado_descripcion'=>($v->estado!=null)?$v->estado_descripcion:"SIN GENERAR",
                        'estado_global'=>$v->estado_global
                    );
                }
            }
        }
        echo json_encode($horariosymarcacionesgenerados);
    }

    /**
     * Función para la obtención del listado descriptivo de marcaciones consderando el cruce entre dos clases de marcación.
     * El uso común de esta función será cuando se requiera comparar los estados entre lo previsto (H) y lo efectivo (M).
     */
    function listdescriptivomarcacionescruzadaAction(){
        $this->view->disable();
        $horariosymarcacionesgenerados = Array();
        if(isset($_POST["id"])&&$_POST["id"]>0&&isset($_POST["clasemarcacionA"])&&isset($_POST["clasemarcacionB"])){
            $obj = new Fhorariosymarcacionesgenerados();
            $idRelaboral = $_POST["id"];
            $clasemarcacionA = $_POST["clasemarcacionA"];
            $clasemarcacionB = $_POST["clasemarcacionB"];
            $resul = $obj->getAllCruzada($idRelaboral,0,0,$clasemarcacionA,$clasemarcacionB);
            //comprobamos si hay filas
            if ($resul->count() > 0) {
                foreach ($resul as $v) {
                    $horariosymarcacionesgenerados[] = array(
                        'nro_row' => 0,
                        'id_relaboral'=>$v->id_relaboral,
                        'id_perfillaboral'=>$v->id_perfillaboral,
                        'perfil_laboral'=>$v->perfil_laboral,
                        'grupo'=>$v->grupo,
                        'perfil_fecha_ini'=>$v->perfil_fecha_ini != "" ? date("d-m-Y", strtotime($v->perfil_fecha_ini)) : "",
                        'perfil_fecha_fin'=>$v->perfil_fecha_fin != "" ? date("d-m-Y", strtotime($v->perfil_fecha_fin)) : "",
                        'gestion'=>$v->gestion,
                        'mes'=>$v->mes,
                        'mes_nombre'=>$v->mes_nombre,
                        'rango_fecha_ini'=>$v->rango_fecha_ini != "" ? date("d-m-Y", strtotime($v->rango_fecha_ini)) : "",
                        'rango_fecha_fin'=>$v->rango_fecha_fin != "" ? date("d-m-Y", strtotime($v->rango_fecha_fin)) : "",
                        'estado'=>$v->estado,
                        'estado_descripcion'=>($v->estado!=null)?$v->estado_descripcion:"SIN GENERAR",
                        'estado_global'=>$v->estado_global,
                        'prevista_estado'=>$v->prevista_estado,
                        'prevista_estado_descripcion'=>$v->prevista_estado_descripcion,
                        'prevista_estado_global'=>$v->prevista_estado_global
                    );
                }
            }
        }
        echo json_encode($horariosymarcacionesgenerados);
    }

    /**
     * Función para la generación del registro de marcación PREVISTA para un registro de relación laboral, gestión y mes determinados.
     */
    function generarmarcacionprevistaAction(){
        $auth = $this->session->get('auth');
        $user_reg_id = $user_mod_id = $auth['id'];
        $msj = Array();
        $hoy = date("Y-m-d H:i:s");
        $this->view->disable();
        if(isset($_POST["opcion"])&&$_POST["opcion"]>0){
            #region Edición de Registro
            $idRelaboral = $_POST["id_relaboral"];
            $gestion = $_POST["gestion"];
            $mes = $_POST["mes"];
            $fechaIni = $_POST["fecha_ini"];
            $fechaFin = $_POST["fecha_fin"];
            $clasemarcacion = $_POST["clasemarcacion"];
            $objCL = new Fcalendariolaboral();
            $turno = 0;
            $grupo = 0;
            $consultaEntrada="";
            $consultaSalida="";
            /**
             * Se obtiene el listado de calendarios registrados para los perfiles correspondientes al registro de relación laboral
             */
            $resul = $objCL->getAllRegisteredByPerfilAndRelaboralRangoFechas(0,$idRelaboral,$fechaIni,$fechaFin);
            if ($resul->count() > 0) {
                foreach ($resul as $v) {
                    $tipo_horario = $v->tipo_horario;
                    $turno++;
                    $grupo++;
                    $ultimo_dia=0;
                    $objRango = new Ffechasrango();
                    $rangoFechas = $objRango->getAll($fechaIni,$fechaFin);
                    if ($rangoFechas->count() > 0) {
                        #region Estableciendo los valores para las variables del objeto
                        $consultaEntrada = "relaboral_id=".$idRelaboral." AND ";
                        $consultaEntrada .= "gestion=".$gestion." AND ";
                        $consultaEntrada .= "mes=".$mes." AND ";
                        $consultaEntrada .= "turno=".$turno." AND ";
                        $consultaSalida = $consultaEntrada;
                        $consultaEntrada .= "grupo=".$grupo." AND ";
                        $grupo++;
                        $consultaSalida .= "grupo=".$grupo." AND ";;

                        $consultaEntrada .= "clasemarcacion LIKE '".$clasemarcacion."' AND ";
                        $consultaSalida .= "clasemarcacion LIKE '".$clasemarcacion."' AND ";

                        switch($clasemarcacion){
                            case 'H':
                                $consultaEntrada .= "modalidadmarcacion_id = 1 AND ";
                                $consultaSalida .= "modalidadmarcacion_id = 4 AND ";
                                break;
                            case 'M':
                                $consultaEntrada .= "modalidadmarcacion_id = 2 AND ";
                                $consultaSalida .= "modalidadmarcacion_id = 5 AND ";
                                break;
                            case 'R':
                                $consultaEntrada .= "modalidadmarcacion_id = 3 AND ";
                                break;
                            case 'A':
                                $consultaSalida .= "modalidadmarcacion_id = 6 AND ";
                                break;
                        }
                        $consultaEntrada .= "estado>=1 AND baja_logica=1 ";
                        $consultaSalida .= "estado>=1 AND baja_logica=1 ";
                        /**
                         * Se hace una consulta para ver los registro de entrada y salida válidos
                         */
                        $objMEntrada = Horariosymarcaciones::findFirst(array($consultaEntrada));
                        $objMSalida = Horariosymarcaciones::findFirst(array($consultaSalida));
                        if(is_object($objMEntrada)&&is_object($objMSalida)){

                            /**
                             * Se reinician todos los valores a objeto de no dejar rastros de los anteriores valores.
                             * Sin embargo, el estado para un día en particular esta ya ELABORADO(2), APROBADO (3) o PLANILLADO (4) ya no se modificará el dato
                             */
                            if($objMEntrada->estado1 ==null||$objMEntrada->estado1 <=1){$objMEntrada->d1 =null;$objMEntrada->calendariolaboral1_id=null;$objMEntrada->estado1 =null;}
                            if($objMEntrada->estado2 ==null||$objMEntrada->estado2 <=1){$objMEntrada->d2 =null;$objMEntrada->calendariolaboral2_id=null;$objMEntrada->estado2 =null;}
                            if($objMEntrada->estado3 ==null||$objMEntrada->estado3 <=1){$objMEntrada->d3 =null;$objMEntrada->calendariolaboral3_id=null;$objMEntrada->estado3 =null;}
                            if($objMEntrada->estado4 ==null||$objMEntrada->estado4 <=1){$objMEntrada->d4 =null;$objMEntrada->calendariolaboral4_id=null;$objMEntrada->estado4 =null;}
                            if($objMEntrada->estado5 ==null||$objMEntrada->estado5 <=1){$objMEntrada->d5 =null;$objMEntrada->calendariolaboral5_id=null;$objMEntrada->estado5 =null;}
                            if($objMEntrada->estado6 ==null||$objMEntrada->estado6 <=1){$objMEntrada->d6 =null;$objMEntrada->calendariolaboral6_id=null;$objMEntrada->estado6 =null;}
                            if($objMEntrada->estado7 ==null||$objMEntrada->estado7 <=1){$objMEntrada->d7 =null;$objMEntrada->calendariolaboral7_id=null;$objMEntrada->estado7 =null;}
                            if($objMEntrada->estado8 ==null||$objMEntrada->estado8 <=1){$objMEntrada->d8 =null;$objMEntrada->calendariolaboral8_id=null;$objMEntrada->estado8 =null;}
                            if($objMEntrada->estado9 ==null||$objMEntrada->estado9 <=1){$objMEntrada->d9 =null;$objMEntrada->calendariolaboral9_id=null;$objMEntrada->estado9 =null;}
                            if($objMEntrada->estado10==null||$objMEntrada->estado10<=1){$objMEntrada->d10=null;$objMEntrada->calendariolaboral10_id=null;$objMEntrada->estado10=null;}
                            if($objMEntrada->estado11==null||$objMEntrada->estado11<=1){$objMEntrada->d11=null;$objMEntrada->calendariolaboral11_id=null;$objMEntrada->estado11=null;}
                            if($objMEntrada->estado12==null||$objMEntrada->estado12<=1){$objMEntrada->d12=null;$objMEntrada->calendariolaboral12_id=null;$objMEntrada->estado12=null;}
                            if($objMEntrada->estado13==null||$objMEntrada->estado13<=1){$objMEntrada->d13=null;$objMEntrada->calendariolaboral13_id=null;$objMEntrada->estado13=null;}
                            if($objMEntrada->estado14==null||$objMEntrada->estado14<=1){$objMEntrada->d14=null;$objMEntrada->calendariolaboral14_id=null;$objMEntrada->estado14=null;}
                            if($objMEntrada->estado15==null||$objMEntrada->estado15<=1){$objMEntrada->d15=null;$objMEntrada->calendariolaboral15_id=null;$objMEntrada->estado15=null;}
                            if($objMEntrada->estado16==null||$objMEntrada->estado16<=1){$objMEntrada->d16=null;$objMEntrada->calendariolaboral16_id=null;$objMEntrada->estado16=null;}
                            if($objMEntrada->estado17==null||$objMEntrada->estado17<=1){$objMEntrada->d17=null;$objMEntrada->calendariolaboral17_id=null;$objMEntrada->estado17=null;}
                            if($objMEntrada->estado18==null||$objMEntrada->estado18<=1){$objMEntrada->d18=null;$objMEntrada->calendariolaboral18_id=null;$objMEntrada->estado18=null;}
                            if($objMEntrada->estado19==null||$objMEntrada->estado19<=1){$objMEntrada->d19=null;$objMEntrada->calendariolaboral19_id=null;$objMEntrada->estado19=null;}
                            if($objMEntrada->estado20==null||$objMEntrada->estado20<=1){$objMEntrada->d20=null;$objMEntrada->calendariolaboral20_id=null;$objMEntrada->estado20=null;}
                            if($objMEntrada->estado21==null||$objMEntrada->estado21<=1){$objMEntrada->d21=null;$objMEntrada->calendariolaboral21_id=null;$objMEntrada->estado21=null;}
                            if($objMEntrada->estado22==null||$objMEntrada->estado22<=1){$objMEntrada->d22=null;$objMEntrada->calendariolaboral22_id=null;$objMEntrada->estado22=null;}
                            if($objMEntrada->estado23==null||$objMEntrada->estado23<=1){$objMEntrada->d23=null;$objMEntrada->calendariolaboral23_id=null;$objMEntrada->estado23=null;}
                            if($objMEntrada->estado24==null||$objMEntrada->estado24<=1){$objMEntrada->d24=null;$objMEntrada->calendariolaboral24_id=null;$objMEntrada->estado24=null;}
                            if($objMEntrada->estado25==null||$objMEntrada->estado25<=1){$objMEntrada->d25=null;$objMEntrada->calendariolaboral25_id=null;$objMEntrada->estado25=null;}
                            if($objMEntrada->estado26==null||$objMEntrada->estado26<=1){$objMEntrada->d26=null;$objMEntrada->calendariolaboral26_id=null;$objMEntrada->estado26=null;}
                            if($objMEntrada->estado27==null||$objMEntrada->estado27<=1){$objMEntrada->d27=null;$objMEntrada->calendariolaboral27_id=null;$objMEntrada->estado27=null;}
                            if($objMEntrada->estado28==null||$objMEntrada->estado28<=1){$objMEntrada->d28=null;$objMEntrada->calendariolaboral28_id=null;$objMEntrada->estado28=null;}
                            if($objMEntrada->estado29==null||$objMEntrada->estado29<=1){$objMEntrada->d29=null;$objMEntrada->calendariolaboral29_id=null;$objMEntrada->estado29=null;}
                            if($objMEntrada->estado30==null||$objMEntrada->estado30<=1){$objMEntrada->d30=null;$objMEntrada->calendariolaboral30_id=null;$objMEntrada->estado30=null;}
                            if($objMEntrada->estado31==null||$objMEntrada->estado31<=1){$objMEntrada->d31=null;$objMEntrada->calendariolaboral31_id=null;$objMEntrada->estado31=null;}

                            if($objMSalida->estado1 ==null||$objMSalida->estado1 <=1){$objMSalida->d1 =null;$objMSalida->calendariolaboral1_id=null;$objMSalida->estado1 =null;}
                            if($objMSalida->estado2 ==null||$objMSalida->estado2 <=1){$objMSalida->d2 =null;$objMSalida->calendariolaboral2_id=null;$objMSalida->estado2 =null;}
                            if($objMSalida->estado3 ==null||$objMSalida->estado3 <=1){$objMSalida->d3 =null;$objMSalida->calendariolaboral3_id=null;$objMSalida->estado3 =null;}
                            if($objMSalida->estado4 ==null||$objMSalida->estado4 <=1){$objMSalida->d4 =null;$objMSalida->calendariolaboral4_id=null;$objMSalida->estado4 =null;}
                            if($objMSalida->estado5 ==null||$objMSalida->estado5 <=1){$objMSalida->d5 =null;$objMSalida->calendariolaboral5_id=null;$objMSalida->estado5 =null;}
                            if($objMSalida->estado6 ==null||$objMSalida->estado6 <=1){$objMSalida->d6 =null;$objMSalida->calendariolaboral6_id=null;$objMSalida->estado6 =null;}
                            if($objMSalida->estado7 ==null||$objMSalida->estado7 <=1){$objMSalida->d7 =null;$objMSalida->calendariolaboral7_id=null;$objMSalida->estado7 =null;}
                            if($objMSalida->estado8 ==null||$objMSalida->estado8 <=1){$objMSalida->d8 =null;$objMSalida->calendariolaboral8_id=null;$objMSalida->estado8 =null;}
                            if($objMSalida->estado9 ==null||$objMSalida->estado9 <=1){$objMSalida->d9 =null;$objMSalida->calendariolaboral9_id=null;$objMSalida->estado9 =null;}
                            if($objMSalida->estado10==null||$objMSalida->estado10<=1){$objMSalida->d10=null;$objMSalida->calendariolaboral10_id=null;$objMSalida->estado10=null;}
                            if($objMSalida->estado11==null||$objMSalida->estado11<=1){$objMSalida->d11=null;$objMSalida->calendariolaboral11_id=null;$objMSalida->estado11=null;}
                            if($objMSalida->estado12==null||$objMSalida->estado12<=1){$objMSalida->d12=null;$objMSalida->calendariolaboral12_id=null;$objMSalida->estado12=null;}
                            if($objMSalida->estado13==null||$objMSalida->estado13<=1){$objMSalida->d13=null;$objMSalida->calendariolaboral13_id=null;$objMSalida->estado13=null;}
                            if($objMSalida->estado14==null||$objMSalida->estado14<=1){$objMSalida->d14=null;$objMSalida->calendariolaboral14_id=null;$objMSalida->estado14=null;}
                            if($objMSalida->estado15==null||$objMSalida->estado15<=1){$objMSalida->d15=null;$objMSalida->calendariolaboral15_id=null;$objMSalida->estado15=null;}
                            if($objMSalida->estado16==null||$objMSalida->estado16<=1){$objMSalida->d16=null;$objMSalida->calendariolaboral16_id=null;$objMSalida->estado16=null;}
                            if($objMSalida->estado17==null||$objMSalida->estado17<=1){$objMSalida->d17=null;$objMSalida->calendariolaboral17_id=null;$objMSalida->estado17=null;}
                            if($objMSalida->estado18==null||$objMSalida->estado18<=1){$objMSalida->d18=null;$objMSalida->calendariolaboral18_id=null;$objMSalida->estado18=null;}
                            if($objMSalida->estado19==null||$objMSalida->estado19<=1){$objMSalida->d19=null;$objMSalida->calendariolaboral19_id=null;$objMSalida->estado19=null;}
                            if($objMSalida->estado20==null||$objMSalida->estado20<=1){$objMSalida->d20=null;$objMSalida->calendariolaboral20_id=null;$objMSalida->estado20=null;}
                            if($objMSalida->estado21==null||$objMSalida->estado21<=1){$objMSalida->d21=null;$objMSalida->calendariolaboral21_id=null;$objMSalida->estado21=null;}
                            if($objMSalida->estado22==null||$objMSalida->estado22<=1){$objMSalida->d22=null;$objMSalida->calendariolaboral22_id=null;$objMSalida->estado22=null;}
                            if($objMSalida->estado23==null||$objMSalida->estado23<=1){$objMSalida->d23=null;$objMSalida->calendariolaboral23_id=null;$objMSalida->estado23=null;}
                            if($objMSalida->estado24==null||$objMSalida->estado24<=1){$objMSalida->d24=null;$objMSalida->calendariolaboral24_id=null;$objMSalida->estado24=null;}
                            if($objMSalida->estado25==null||$objMSalida->estado25<=1){$objMSalida->d25=null;$objMSalida->calendariolaboral25_id=null;$objMSalida->estado25=null;}
                            if($objMSalida->estado26==null||$objMSalida->estado26<=1){$objMSalida->d26=null;$objMSalida->calendariolaboral26_id=null;$objMSalida->estado26=null;}
                            if($objMSalida->estado27==null||$objMSalida->estado27<=1){$objMSalida->d27=null;$objMSalida->calendariolaboral27_id=null;$objMSalida->estado27=null;}
                            if($objMSalida->estado28==null||$objMSalida->estado28<=1){$objMSalida->d28=null;$objMSalida->calendariolaboral28_id=null;$objMSalida->estado28=null;}
                            if($objMSalida->estado29==null||$objMSalida->estado29<=1){$objMSalida->d29=null;$objMSalida->calendariolaboral29_id=null;$objMSalida->estado29=null;}
                            if($objMSalida->estado30==null||$objMSalida->estado30<=1){$objMSalida->d30=null;$objMSalida->calendariolaboral30_id=null;$objMSalida->estado30=null;}
                            if($objMSalida->estado31==null||$objMSalida->estado31<=1){$objMSalida->d31=null;$objMSalida->calendariolaboral31_id=null;$objMSalida->estado31=null;}

                            foreach($rangoFechas as $rango){
                                $cal = Calendarioslaborales::find(array("perfillaboral_id=".$v->id_perfillaboral." AND horariolaboral_id=".$v->id_horariolaboral." AND '".$rango->fecha."' BETWEEN fecha_ini AND fecha_fin AND estado>=1 AND baja_logica=1"));
                                if($cal->count()>0){
                                    foreach($cal as $cl){
                                        $arrFecha= explode("-",$rango->fecha);
                                        $dia = intval($arrFecha[2]);
                                        switch($dia){
                                            case 1 :if($objMEntrada->estado1 ==null&&(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3)){$objMEntrada->calendariolaboral1_id=$cl->id; $objMEntrada->estado1 =1;$objMEntrada->d1 =$v->hora_entrada;}if($objMSalida->estado1 ==null&&(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3)){$objMSalida->calendariolaboral1_id=$cl->id; $objMSalida->estado1 =1;$objMSalida->d1 =$v->hora_salida;}$ultimo_dia=1 ;break;
                                            case 2 :if($objMEntrada->estado2 ==null&&(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3)){$objMEntrada->calendariolaboral2_id=$cl->id; $objMEntrada->estado2 =1;$objMEntrada->d2 =$v->hora_entrada;}if($objMSalida->estado2 ==null&&(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3)){$objMSalida->calendariolaboral2_id=$cl->id; $objMSalida->estado2 =1;$objMSalida->d2 =$v->hora_salida;}$ultimo_dia=2 ;break;
                                            case 3 :if($objMEntrada->estado3 ==null&&(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3)){$objMEntrada->calendariolaboral3_id=$cl->id; $objMEntrada->estado3 =1;$objMEntrada->d3 =$v->hora_entrada;}if($objMSalida->estado3 ==null&&(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3)){$objMSalida->calendariolaboral3_id=$cl->id; $objMSalida->estado3 =1;$objMSalida->d3 =$v->hora_salida;}$ultimo_dia=3 ;break;
                                            case 4 :if($objMEntrada->estado4 ==null&&(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3)){$objMEntrada->calendariolaboral4_id=$cl->id; $objMEntrada->estado4 =1;$objMEntrada->d4 =$v->hora_entrada;}if($objMSalida->estado4 ==null&&(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3)){$objMSalida->calendariolaboral4_id=$cl->id; $objMSalida->estado4 =1;$objMSalida->d4 =$v->hora_salida;}$ultimo_dia=4 ;break;
                                            case 5 :if($objMEntrada->estado5 ==null&&(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3)){$objMEntrada->calendariolaboral5_id=$cl->id; $objMEntrada->estado5 =1;$objMEntrada->d5 =$v->hora_entrada;}if($objMSalida->estado5 ==null&&(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3)){$objMSalida->calendariolaboral5_id=$cl->id; $objMSalida->estado5 =1;$objMSalida->d5 =$v->hora_salida;}$ultimo_dia=5 ;break;
                                            case 6 :if($objMEntrada->estado6 ==null&&(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3)){$objMEntrada->calendariolaboral6_id=$cl->id; $objMEntrada->estado6 =1;$objMEntrada->d6 =$v->hora_entrada;}if($objMSalida->estado6 ==null&&(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3)){$objMSalida->calendariolaboral6_id=$cl->id; $objMSalida->estado6 =1;$objMSalida->d6 =$v->hora_salida;}$ultimo_dia=6 ;break;
                                            case 7 :if($objMEntrada->estado7 ==null&&(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3)){$objMEntrada->calendariolaboral7_id=$cl->id; $objMEntrada->estado7 =1;$objMEntrada->d7 =$v->hora_entrada;}if($objMSalida->estado7 ==null&&(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3)){$objMSalida->calendariolaboral7_id=$cl->id; $objMSalida->estado7 =1;$objMSalida->d7 =$v->hora_salida;}$ultimo_dia=7 ;break;
                                            case 8 :if($objMEntrada->estado8 ==null&&(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3)){$objMEntrada->calendariolaboral8_id=$cl->id; $objMEntrada->estado8 =1;$objMEntrada->d8 =$v->hora_entrada;}if($objMSalida->estado8 ==null&&(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3)){$objMSalida->calendariolaboral8_id=$cl->id; $objMSalida->estado8 =1;$objMSalida->d8 =$v->hora_salida;}$ultimo_dia=8 ;break;
                                            case 9 :if($objMEntrada->estado9 ==null&&(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3)){$objMEntrada->calendariolaboral9_id=$cl->id; $objMEntrada->estado9 =1;$objMEntrada->d9 =$v->hora_entrada;}if($objMSalida->estado9 ==null&&(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3)){$objMSalida->calendariolaboral9_id=$cl->id; $objMSalida->estado9 =1;$objMSalida->d9 =$v->hora_salida;}$ultimo_dia=9 ;break;
                                            case 10:if($objMEntrada->estado10==null&&(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3)){$objMEntrada->calendariolaboral10_id=$cl->id;$objMEntrada->estado10=1;$objMEntrada->d10=$v->hora_entrada;}if($objMSalida->estado10==null&&(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3)){$objMSalida->calendariolaboral10_id=$cl->id;$objMSalida->estado10=1;$objMSalida->d10=$v->hora_salida;}$ultimo_dia=10;break;
                                            case 11:if($objMEntrada->estado11==null&&(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3)){$objMEntrada->calendariolaboral11_id=$cl->id;$objMEntrada->estado11=1;$objMEntrada->d11=$v->hora_entrada;}if($objMSalida->estado11==null&&(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3)){$objMSalida->calendariolaboral11_id=$cl->id;$objMSalida->estado11=1;$objMSalida->d11=$v->hora_salida;}$ultimo_dia=11;break;
                                            case 12:if($objMEntrada->estado12==null&&(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3)){$objMEntrada->calendariolaboral12_id=$cl->id;$objMEntrada->estado12=1;$objMEntrada->d12=$v->hora_entrada;}if($objMSalida->estado12==null&&(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3)){$objMSalida->calendariolaboral12_id=$cl->id;$objMSalida->estado12=1;$objMSalida->d12=$v->hora_salida;}$ultimo_dia=12;break;
                                            case 13:if($objMEntrada->estado13==null&&(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3)){$objMEntrada->calendariolaboral13_id=$cl->id;$objMEntrada->estado13=1;$objMEntrada->d13=$v->hora_entrada;}if($objMSalida->estado13==null&&(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3)){$objMSalida->calendariolaboral13_id=$cl->id;$objMSalida->estado13=1;$objMSalida->d13=$v->hora_salida;}$ultimo_dia=13;break;
                                            case 14:if($objMEntrada->estado14==null&&(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3)){$objMEntrada->calendariolaboral14_id=$cl->id;$objMEntrada->estado14=1;$objMEntrada->d14=$v->hora_entrada;}if($objMSalida->estado14==null&&(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3)){$objMSalida->calendariolaboral14_id=$cl->id;$objMSalida->estado14=1;$objMSalida->d14=$v->hora_salida;}$ultimo_dia=14;break;
                                            case 15:if($objMEntrada->estado15==null&&(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3)){$objMEntrada->calendariolaboral15_id=$cl->id;$objMEntrada->estado15=1;$objMEntrada->d15=$v->hora_entrada;}if($objMSalida->estado15==null&&(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3)){$objMSalida->calendariolaboral15_id=$cl->id;$objMSalida->estado15=1;$objMSalida->d15=$v->hora_salida;}$ultimo_dia=15;break;
                                            case 16:if($objMEntrada->estado16==null&&(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3)){$objMEntrada->calendariolaboral16_id=$cl->id;$objMEntrada->estado16=1;$objMEntrada->d16=$v->hora_entrada;}if($objMSalida->estado16==null&&(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3)){$objMSalida->calendariolaboral16_id=$cl->id;$objMSalida->estado16=1;$objMSalida->d16=$v->hora_salida;}$ultimo_dia=16;break;
                                            case 17:if($objMEntrada->estado17==null&&(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3)){$objMEntrada->calendariolaboral17_id=$cl->id;$objMEntrada->estado17=1;$objMEntrada->d17=$v->hora_entrada;}if($objMSalida->estado17==null&&(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3)){$objMSalida->calendariolaboral17_id=$cl->id;$objMSalida->estado17=1;$objMSalida->d17=$v->hora_salida;}$ultimo_dia=17;break;
                                            case 18:if($objMEntrada->estado18==null&&(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3)){$objMEntrada->calendariolaboral18_id=$cl->id;$objMEntrada->estado18=1;$objMEntrada->d18=$v->hora_entrada;}if($objMSalida->estado18==null&&(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3)){$objMSalida->calendariolaboral18_id=$cl->id;$objMSalida->estado18=1;$objMSalida->d18=$v->hora_salida;}$ultimo_dia=18;break;
                                            case 19:if($objMEntrada->estado19==null&&(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3)){$objMEntrada->calendariolaboral19_id=$cl->id;$objMEntrada->estado19=1;$objMEntrada->d19=$v->hora_entrada;}if($objMSalida->estado19==null&&(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3)){$objMSalida->calendariolaboral19_id=$cl->id;$objMSalida->estado19=1;$objMSalida->d19=$v->hora_salida;}$ultimo_dia=19;break;
                                            case 20:if($objMEntrada->estado20==null&&(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3)){$objMEntrada->calendariolaboral20_id=$cl->id;$objMEntrada->estado20=1;$objMEntrada->d20=$v->hora_entrada;}if($objMSalida->estado20==null&&(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3)){$objMSalida->calendariolaboral20_id=$cl->id;$objMSalida->estado20=1;$objMSalida->d20=$v->hora_salida;}$ultimo_dia=20;break;
                                            case 21:if($objMEntrada->estado21==null&&(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3)){$objMEntrada->calendariolaboral21_id=$cl->id;$objMEntrada->estado21=1;$objMEntrada->d21=$v->hora_entrada;}if($objMSalida->estado21==null&&(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3)){$objMSalida->calendariolaboral21_id=$cl->id;$objMSalida->estado21=1;$objMSalida->d21=$v->hora_salida;}$ultimo_dia=21;break;
                                            case 22:if($objMEntrada->estado22==null&&(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3)){$objMEntrada->calendariolaboral22_id=$cl->id;$objMEntrada->estado22=1;$objMEntrada->d22=$v->hora_entrada;}if($objMSalida->estado22==null&&(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3)){$objMSalida->calendariolaboral22_id=$cl->id;$objMSalida->estado22=1;$objMSalida->d22=$v->hora_salida;}$ultimo_dia=22;break;
                                            case 23:if($objMEntrada->estado23==null&&(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3)){$objMEntrada->calendariolaboral23_id=$cl->id;$objMEntrada->estado23=1;$objMEntrada->d23=$v->hora_entrada;}if($objMSalida->estado23==null&&(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3)){$objMSalida->calendariolaboral23_id=$cl->id;$objMSalida->estado23=1;$objMSalida->d23=$v->hora_salida;}$ultimo_dia=23;break;
                                            case 24:if($objMEntrada->estado24==null&&(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3)){$objMEntrada->calendariolaboral24_id=$cl->id;$objMEntrada->estado24=1;$objMEntrada->d24=$v->hora_entrada;}if($objMSalida->estado24==null&&(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3)){$objMSalida->calendariolaboral24_id=$cl->id;$objMSalida->estado24=1;$objMSalida->d24=$v->hora_salida;}$ultimo_dia=24;break;
                                            case 25:if($objMEntrada->estado25==null&&(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3)){$objMEntrada->calendariolaboral25_id=$cl->id;$objMEntrada->estado25=1;$objMEntrada->d25=$v->hora_entrada;}if($objMSalida->estado25==null&&(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3)){$objMSalida->calendariolaboral25_id=$cl->id;$objMSalida->estado25=1;$objMSalida->d25=$v->hora_salida;}$ultimo_dia=25;break;
                                            case 26:if($objMEntrada->estado26==null&&(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3)){$objMEntrada->calendariolaboral26_id=$cl->id;$objMEntrada->estado26=1;$objMEntrada->d26=$v->hora_entrada;}if($objMSalida->estado26==null&&(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3)){$objMSalida->calendariolaboral26_id=$cl->id;$objMSalida->estado26=1;$objMSalida->d26=$v->hora_salida;}$ultimo_dia=26;break;
                                            case 27:if($objMEntrada->estado27==null&&(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3)){$objMEntrada->calendariolaboral27_id=$cl->id;$objMEntrada->estado27=1;$objMEntrada->d27=$v->hora_entrada;}if($objMSalida->estado27==null&&(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3)){$objMSalida->calendariolaboral27_id=$cl->id;$objMSalida->estado27=1;$objMSalida->d27=$v->hora_salida;}$ultimo_dia=27;break;
                                            case 28:if($objMEntrada->estado28==null&&(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3)){$objMEntrada->calendariolaboral28_id=$cl->id;$objMEntrada->estado28=1;$objMEntrada->d28=$v->hora_entrada;}if($objMSalida->estado28==null&&(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3)){$objMSalida->calendariolaboral28_id=$cl->id;$objMSalida->estado28=1;$objMSalida->d28=$v->hora_salida;}$ultimo_dia=28;break;
                                            case 29:if($objMEntrada->estado29==null&&(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3)){$objMEntrada->calendariolaboral29_id=$cl->id;$objMEntrada->estado29=1;$objMEntrada->d29=$v->hora_entrada;}if($objMSalida->estado29==null&&(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3)){$objMSalida->calendariolaboral29_id=$cl->id;$objMSalida->estado29=1;$objMSalida->d29=$v->hora_salida;}$ultimo_dia=29;break;
                                            case 30:if($objMEntrada->estado30==null&&(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3)){$objMEntrada->calendariolaboral30_id=$cl->id;$objMEntrada->estado30=1;$objMEntrada->d30=$v->hora_entrada;}if($objMSalida->estado30==null&&(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3)){$objMSalida->calendariolaboral30_id=$cl->id;$objMSalida->estado30=1;$objMSalida->d30=$v->hora_salida;}$ultimo_dia=30;break;
                                            case 31:if($objMEntrada->estado31==null&&(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3)){$objMEntrada->calendariolaboral31_id=$cl->id;$objMEntrada->estado31=1;$objMEntrada->d31=$v->hora_entrada;}if($objMSalida->estado31==null&&(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3)){$objMSalida->calendariolaboral31_id=$cl->id;$objMSalida->estado31=1;$objMSalida->d31=$v->hora_salida;}$ultimo_dia=31;break;
                                        }
                                    }
                                }
                            }
                            $objMEntrada->ultimo_dia=$ultimo_dia;$objMSalida->ultimo_dia=$ultimo_dia;
                            $objMEntrada->estado=1;$objMSalida->estado=1;
                            $objMEntrada->baja_logica=1;$objMSalida->baja_logica=1;
                            $objMEntrada->agrupador=0;$objMSalida->agrupador=0;
                            $objMEntrada->user_mod_id=$user_mod_id;$objMSalida->user_mod_id=$user_mod_id;
                            $objMEntrada->fecha_mod=$hoy;$objMSalida->fecha_mod=$hoy;
                            try{
                                $okE = $objMEntrada->save();
                                $okS = $objMSalida->save();
                                if ($okS)  {
                                    $msj = array('result' => 1, 'msj' => '&Eacute;xito: El detalle correspondiente a los registros previstos de marcaci&oacute;n se volvieron a generar correctamente.');
                                } else {
                                    $msj = array('result' => 0, 'msj' => 'Error: No se modific&oacute; el detalle correspondiente a los registro previstos de marcación.');
                                }
                            }catch (\Exception $e) {
                                echo get_class($e), ": ", $e->getMessage(), "\n";
                                echo " File=", $e->getFile(), "\n";
                                echo " Line=", $e->getLine(), "\n";
                                echo $e->getTraceAsString();
                                $msj = array('result' => -1, 'msj' => 'Error cr&iacute;tico: No se modific&oacute; el detalle correspondiente a registros previstos de marcaci&oacute;n.');
                            }
                        }else{
                            $msj = array('result' => 0, 'msj' => 'Error: No se modific&oacute; el detalle correspondiente a los registro previstos de marcación debido a que no se hall&oacute; los registros correspondientes en la base de datos.');
                        }
                        #endregion Estableciendo los valores para las variables del objeto
                    }
                }
            }
            else{
                $msj = array('result' => 0, 'msj' => 'Error: No se gener&oacute; el registro de marcaciones debido a que no se encontr&oacute; registros de calendarizaci&oacute;n para el mes solicitado.');
            }
            #endregion Edición de Registro
        }else{
            if(isset($_POST["id_relaboral"])&&$_POST["id_relaboral"]>0&&isset($_POST["gestion"])&&isset($_POST["mes"])&&isset($_POST["clasemarcacion"])){
                #region Nuevo Registro
                $idRelaboral = $_POST["id_relaboral"];
                $gestion = $_POST["gestion"];
                $mes = $_POST["mes"];
                $fechaIni = $_POST["fecha_ini"];
                $fechaFin = $_POST["fecha_fin"];
                $clasemarcacion = $_POST["clasemarcacion"];
                $objCL = new Fcalendariolaboral();
                $turno = 0;
                $grupo = 0;
                /**
                 * Se obtiene el listado de calendarios registrados para los perfiles correspondientes al registro de relación laboral
                 */
                $resul = $objCL->getAllRegisteredByPerfilAndRelaboralRangoFechas(0,$idRelaboral,$fechaIni,$fechaFin);
                if ($resul->count() > 0) {
                    foreach ($resul as $v) {
                        $objMEntrada = new Horariosymarcaciones();
                        $objMSalida = new Horariosymarcaciones();
                        $tipo_horario = $v->tipo_horario;
                        $turno++;
                        $grupo++;
                        $ultimo_dia=0;
                        $objRango = new Ffechasrango();
                        $rangoFechas = $objRango->getAll($fechaIni,$fechaFin);
                        if ($rangoFechas->count() > 0) {
                            #region Estableciendo los valores para las variables del objeto
                            $objMEntrada->relaboral_id=$idRelaboral;$objMSalida->relaboral_id=$idRelaboral;
                            $objMEntrada->gestion=$gestion;$objMSalida->gestion=$gestion;
                            $objMEntrada->mes=$mes;$objMSalida->mes=$mes;
                            $objMEntrada->turno=$turno;$objMSalida->turno=$turno;
                            $objMEntrada->grupo=$grupo;$grupo++;$objMSalida->grupo=$grupo;
                            $objMEntrada->clasemarcacion=$clasemarcacion;$objMSalida->clasemarcacion=$clasemarcacion;
                            switch($clasemarcacion){
                                case 'H':
                                    $objMEntrada->modalidadmarcacion_id=1;
                                    $objMSalida->modalidadmarcacion_id=4;
                                    break;
                                case 'M':
                                    $objMEntrada->modalidadmarcacion_id=2;
                                    $objMSalida->modalidadmarcacion_id=5;
                                    break;
                                case 'R':
                                    $objMEntrada->modalidadmarcacion_id=3;
                                    $objMSalida->modalidadmarcacion_id=6;
                                    break;
                                case 'A':
                                    break;
                            }
                            foreach($rangoFechas as $rango){
                                $cal = Calendarioslaborales::find(array("perfillaboral_id=".$v->id_perfillaboral." AND horariolaboral_id=".$v->id_horariolaboral." AND '".$rango->fecha."' BETWEEN fecha_ini AND fecha_fin AND estado>=1 AND baja_logica=1"));
                                if($cal->count()>0){
                                    foreach($cal as $cl){
                                        /**
                                         * Al perfil se le ha asignado una calendarización para esa fecha
                                         */
                                        $arrFecha= explode("-",$rango->fecha);
                                        $dia = intval($arrFecha[2]);
                                        switch($dia){
                                            case 1 :if(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3){$objMEntrada->calendariolaboral1_id=$cl->id; $objMEntrada->estado1 =1;$objMEntrada->d1 =$v->hora_entrada;$objMSalida->calendariolaboral1_id=$cl->id; $objMSalida->estado1 =1;$objMSalida->d1 =$v->hora_salida;}$ultimo_dia=1 ;break;
                                            case 2 :if(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3){$objMEntrada->calendariolaboral2_id=$cl->id; $objMEntrada->estado2 =1;$objMEntrada->d2 =$v->hora_entrada;$objMSalida->calendariolaboral2_id=$cl->id; $objMSalida->estado2 =1;$objMSalida->d2 =$v->hora_salida;}$ultimo_dia=2 ;break;
                                            case 3 :if(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3){$objMEntrada->calendariolaboral3_id=$cl->id; $objMEntrada->estado3 =1;$objMEntrada->d3 =$v->hora_entrada;$objMSalida->calendariolaboral3_id=$cl->id; $objMSalida->estado3 =1;$objMSalida->d3 =$v->hora_salida;}$ultimo_dia=3 ;break;
                                            case 4 :if(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3){$objMEntrada->calendariolaboral4_id=$cl->id; $objMEntrada->estado4 =1;$objMEntrada->d4 =$v->hora_entrada;$objMSalida->calendariolaboral4_id=$cl->id; $objMSalida->estado4 =1;$objMSalida->d4 =$v->hora_salida;}$ultimo_dia=4 ;break;
                                            case 5 :if(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3){$objMEntrada->calendariolaboral5_id=$cl->id; $objMEntrada->estado5 =1;$objMEntrada->d5 =$v->hora_entrada;$objMSalida->calendariolaboral5_id=$cl->id; $objMSalida->estado5 =1;$objMSalida->d5 =$v->hora_salida;}$ultimo_dia=5 ;break;
                                            case 6 :if(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3){$objMEntrada->calendariolaboral6_id=$cl->id; $objMEntrada->estado6 =1;$objMEntrada->d6 =$v->hora_entrada;$objMSalida->calendariolaboral6_id=$cl->id; $objMSalida->estado6 =1;$objMSalida->d6 =$v->hora_salida;}$ultimo_dia=6 ;break;
                                            case 7 :if(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3){$objMEntrada->calendariolaboral7_id=$cl->id; $objMEntrada->estado7 =1;$objMEntrada->d7 =$v->hora_entrada;$objMSalida->calendariolaboral7_id=$cl->id; $objMSalida->estado7 =1;$objMSalida->d7 =$v->hora_salida;}$ultimo_dia=7 ;break;
                                            case 8 :if(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3){$objMEntrada->calendariolaboral8_id=$cl->id; $objMEntrada->estado8 =1;$objMEntrada->d8 =$v->hora_entrada;$objMSalida->calendariolaboral8_id=$cl->id; $objMSalida->estado8 =1;$objMSalida->d8 =$v->hora_salida;}$ultimo_dia=8 ;break;
                                            case 9 :if(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3){$objMEntrada->calendariolaboral9_id=$cl->id; $objMEntrada->estado9 =1;$objMEntrada->d9 =$v->hora_entrada;$objMSalida->calendariolaboral9_id=$cl->id; $objMSalida->estado9 =1;$objMSalida->d9 =$v->hora_salida;}$ultimo_dia=9 ;break;
                                            case 10:if(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3){$objMEntrada->calendariolaboral10_id=$cl->id;$objMEntrada->estado10=1;$objMEntrada->d10=$v->hora_entrada;$objMSalida->calendariolaboral10_id=$cl->id;$objMSalida->estado10=1;$objMSalida->d10=$v->hora_salida;}$ultimo_dia=10;break;
                                            case 11:if(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3){$objMEntrada->calendariolaboral11_id=$cl->id;$objMEntrada->estado11=1;$objMEntrada->d11=$v->hora_entrada;$objMSalida->calendariolaboral11_id=$cl->id;$objMSalida->estado11=1;$objMSalida->d11=$v->hora_salida;}$ultimo_dia=11;break;
                                            case 12:if(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3){$objMEntrada->calendariolaboral12_id=$cl->id;$objMEntrada->estado12=1;$objMEntrada->d12=$v->hora_entrada;$objMSalida->calendariolaboral12_id=$cl->id;$objMSalida->estado12=1;$objMSalida->d12=$v->hora_salida;}$ultimo_dia=12;break;
                                            case 13:if(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3){$objMEntrada->calendariolaboral13_id=$cl->id;$objMEntrada->estado13=1;$objMEntrada->d13=$v->hora_entrada;$objMSalida->calendariolaboral13_id=$cl->id;$objMSalida->estado13=1;$objMSalida->d13=$v->hora_salida;}$ultimo_dia=13;break;
                                            case 14:if(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3){$objMEntrada->calendariolaboral14_id=$cl->id;$objMEntrada->estado14=1;$objMEntrada->d14=$v->hora_entrada;$objMSalida->calendariolaboral14_id=$cl->id;$objMSalida->estado14=1;$objMSalida->d14=$v->hora_salida;}$ultimo_dia=14;break;
                                            case 15:if(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3){$objMEntrada->calendariolaboral15_id=$cl->id;$objMEntrada->estado15=1;$objMEntrada->d15=$v->hora_entrada;$objMSalida->calendariolaboral15_id=$cl->id;$objMSalida->estado15=1;$objMSalida->d15=$v->hora_salida;}$ultimo_dia=15;break;
                                            case 16:if(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3){$objMEntrada->calendariolaboral16_id=$cl->id;$objMEntrada->estado16=1;$objMEntrada->d16=$v->hora_entrada;$objMSalida->calendariolaboral16_id=$cl->id;$objMSalida->estado16=1;$objMSalida->d16=$v->hora_salida;}$ultimo_dia=16;break;
                                            case 17:if(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3){$objMEntrada->calendariolaboral17_id=$cl->id;$objMEntrada->estado17=1;$objMEntrada->d17=$v->hora_entrada;$objMSalida->calendariolaboral17_id=$cl->id;$objMSalida->estado17=1;$objMSalida->d17=$v->hora_salida;}$ultimo_dia=17;break;
                                            case 18:if(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3){$objMEntrada->calendariolaboral18_id=$cl->id;$objMEntrada->estado18=1;$objMEntrada->d18=$v->hora_entrada;$objMSalida->calendariolaboral18_id=$cl->id;$objMSalida->estado18=1;$objMSalida->d18=$v->hora_salida;}$ultimo_dia=18;break;
                                            case 19:if(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3){$objMEntrada->calendariolaboral19_id=$cl->id;$objMEntrada->estado19=1;$objMEntrada->d19=$v->hora_entrada;$objMSalida->calendariolaboral19_id=$cl->id;$objMSalida->estado19=1;$objMSalida->d19=$v->hora_salida;}$ultimo_dia=19;break;
                                            case 20:if(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3){$objMEntrada->calendariolaboral20_id=$cl->id;$objMEntrada->estado20=1;$objMEntrada->d20=$v->hora_entrada;$objMSalida->calendariolaboral20_id=$cl->id;$objMSalida->estado20=1;$objMSalida->d20=$v->hora_salida;}$ultimo_dia=20;break;
                                            case 21:if(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3){$objMEntrada->calendariolaboral21_id=$cl->id;$objMEntrada->estado21=1;$objMEntrada->d21=$v->hora_entrada;$objMSalida->calendariolaboral21_id=$cl->id;$objMSalida->estado21=1;$objMSalida->d21=$v->hora_salida;}$ultimo_dia=21;break;
                                            case 22:if(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3){$objMEntrada->calendariolaboral22_id=$cl->id;$objMEntrada->estado22=1;$objMEntrada->d22=$v->hora_entrada;$objMSalida->calendariolaboral22_id=$cl->id;$objMSalida->estado22=1;$objMSalida->d22=$v->hora_salida;}$ultimo_dia=22;break;
                                            case 23:if(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3){$objMEntrada->calendariolaboral23_id=$cl->id;$objMEntrada->estado23=1;$objMEntrada->d23=$v->hora_entrada;$objMSalida->calendariolaboral23_id=$cl->id;$objMSalida->estado23=1;$objMSalida->d23=$v->hora_salida;}$ultimo_dia=23;break;
                                            case 24:if(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3){$objMEntrada->calendariolaboral24_id=$cl->id;$objMEntrada->estado24=1;$objMEntrada->d24=$v->hora_entrada;$objMSalida->calendariolaboral24_id=$cl->id;$objMSalida->estado24=1;$objMSalida->d24=$v->hora_salida;}$ultimo_dia=24;break;
                                            case 25:if(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3){$objMEntrada->calendariolaboral25_id=$cl->id;$objMEntrada->estado25=1;$objMEntrada->d25=$v->hora_entrada;$objMSalida->calendariolaboral25_id=$cl->id;$objMSalida->estado25=1;$objMSalida->d25=$v->hora_salida;}$ultimo_dia=25;break;
                                            case 26:if(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3){$objMEntrada->calendariolaboral26_id=$cl->id;$objMEntrada->estado26=1;$objMEntrada->d26=$v->hora_entrada;$objMSalida->calendariolaboral26_id=$cl->id;$objMSalida->estado26=1;$objMSalida->d26=$v->hora_salida;}$ultimo_dia=26;break;
                                            case 27:if(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3){$objMEntrada->calendariolaboral27_id=$cl->id;$objMEntrada->estado27=1;$objMEntrada->d27=$v->hora_entrada;$objMSalida->calendariolaboral27_id=$cl->id;$objMSalida->estado27=1;$objMSalida->d27=$v->hora_salida;}$ultimo_dia=27;break;
                                            case 28:if(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3){$objMEntrada->calendariolaboral28_id=$cl->id;$objMEntrada->estado28=1;$objMEntrada->d28=$v->hora_entrada;$objMSalida->calendariolaboral28_id=$cl->id;$objMSalida->estado28=1;$objMSalida->d28=$v->hora_salida;}$ultimo_dia=28;break;
                                            case 29:if(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3){$objMEntrada->calendariolaboral29_id=$cl->id;$objMEntrada->estado29=1;$objMEntrada->d29=$v->hora_entrada;$objMSalida->calendariolaboral29_id=$cl->id;$objMSalida->estado29=1;$objMSalida->d29=$v->hora_salida;}$ultimo_dia=29;break;
                                            case 30:if(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3){$objMEntrada->calendariolaboral30_id=$cl->id;$objMEntrada->estado30=1;$objMEntrada->d30=$v->hora_entrada;$objMSalida->calendariolaboral30_id=$cl->id;$objMSalida->estado30=1;$objMSalida->d30=$v->hora_salida;}$ultimo_dia=30;break;
                                            case 31:if(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3){$objMEntrada->calendariolaboral31_id=$cl->id;$objMEntrada->estado31=1;$objMEntrada->d31=$v->hora_entrada;$objMSalida->calendariolaboral31_id=$cl->id;$objMSalida->estado31=1;$objMSalida->d31=$v->hora_salida;}$ultimo_dia=31;break;
                                        }
                                    }
                                }
                            }
                            #endregion Estableciendo los valores para las variables del objeto
                        }
                        $objMEntrada->ultimo_dia=$ultimo_dia;$objMSalida->ultimo_dia=$ultimo_dia;
                        $objMEntrada->estado=1;$objMSalida->estado=1;
                        $objMEntrada->baja_logica=1;$objMSalida->baja_logica=1;
                        $objMEntrada->agrupador=0;$objMSalida->agrupador=0;
                        $objMEntrada->user_reg_id=$user_reg_id;$objMSalida->user_reg_id=$user_reg_id;
                        $objMEntrada->fecha_reg=$hoy;$objMSalida->fecha_reg=$hoy;
                        try{
                            $okE = $objMEntrada->save();
                            $okS = $objMSalida->save();
                            if ($okE&&$okS)  {
                                $msj = array('result' => 1, 'msj' => '&Eacute;xito: El detalle correspondiente a los registros previstos de marcaci&oacute;n fueron generados correctamente.');
                            } else {
                                $msj = array('result' => 0, 'msj' => 'Error: No se guard&oacute; el detalle correspondiente a los registro previstos de marcación.');
                            }
                        }catch (\Exception $e) {
                            echo get_class($e), ": ", $e->getMessage(), "\n";
                            echo " File=", $e->getFile(), "\n";
                            echo " Line=", $e->getLine(), "\n";
                            echo $e->getTraceAsString();
                            $msj = array('result' => -1, 'msj' => 'Error cr&iacute;tico: No se guard&oacute; el detalle correspondiente a registros previstos de marcaci&oacute;n.');
                        }
                    }
                }
                else{
                    $msj = array('result' => 0, 'msj' => 'Error: No se gener&oacute; el registro de marcaciones debido a que no se encontr&oacute; registros de calendarizaci&oacute;n para el mes solicitado.');
                }
                #endregion Nuevo Registro
            }
        }
        echo json_encode($msj);
    }

    /**
     * Función para la generación del registro de marcación EFECTIVA para un registro de relación laboral, gestión y mes determinados.
     */
    function generarmarcacionefectivaAction(){
        $auth = $this->session->get('auth');
        $user_reg_id = $user_mod_id = $auth['id'];
        $msj = Array();
        $hoy = date("Y-m-d H:i:s");
        $this->view->disable();
        $horariosymarcacionesgenerados = Array();
        if(isset($_POST["opcion"])&&$_POST["opcion"]>0){
            #region Edición de Registro
            $idRelaboral = $_POST["id_relaboral"];
            $gestion = $_POST["gestion"];
            $mes = $_POST["mes"];
            $fechaIni = $_POST["fecha_ini"];
            $fechaFin = $_POST["fecha_fin"];
            $clasemarcacion = $_POST["clasemarcacion"];
            $objCL = new Fcalendariolaboral();
            $turno = 0;
            $grupo = 0;
            $consultaEntrada="";
            $consultaSalida="";
            /**
             * Se obtiene el listado de calendarios registrados para los perfiles correspondientes al registro de relación laboral
             */
            $resul = $objCL->getAllRegisteredByPerfilAndRelaboralRangoFechas(0,$idRelaboral,$fechaIni,$fechaFin);
            if ($resul->count() > 0) {
                foreach ($resul as $v) {
                    $tipo_horario = $v->tipo_horario;
                    $turno++;
                    $grupo++;
                    $ultimo_dia=0;
                    $objRango = new Ffechasrango();
                    $rangoFechas = $objRango->getAll($fechaIni,$fechaFin);
                    if ($rangoFechas->count() > 0) {
                        #region Estableciendo los valores para las variables del objeto
                        $consultaEntrada = "relaboral_id=".$idRelaboral." AND ";
                        $consultaEntrada .= "gestion=".$gestion." AND ";
                        $consultaEntrada .= "mes=".$mes." AND ";
                        $consultaEntrada .= "turno=".$turno." AND ";
                        $consultaSalida = $consultaEntrada;
                        $consultaEntrada .= "grupo=".$grupo." AND ";
                        $grupo++;
                        $consultaSalida .= "grupo=".$grupo." AND ";;

                        $consultaEntrada .= "clasemarcacion LIKE '".$clasemarcacion."' AND ";
                        $consultaSalida .= "clasemarcacion LIKE '".$clasemarcacion."' AND ";

                        switch($clasemarcacion){
                            case 'H':
                                $consultaEntrada .= "modalidadmarcacion_id = 1 AND ";
                                $consultaSalida .= "modalidadmarcacion_id = 4 AND ";
                                break;
                            case 'M':
                                $consultaEntrada .= "modalidadmarcacion_id = 2 AND ";
                                $consultaSalida .= "modalidadmarcacion_id = 5 AND ";
                                break;
                            case 'R':
                                $consultaEntrada .= "modalidadmarcacion_id = 3 AND ";
                                break;
                            case 'A':
                                $consultaSalida .= "modalidadmarcacion_id = 6 AND ";
                                break;
                        }
                        $consultaEntrada .= "estado>=1 AND baja_logica=1 ";
                        $consultaSalida .= "estado>=1 AND baja_logica=1 ";
                        /**
                         * Se hace una consulta para ver los registro de entrada y salida válidos
                         */
                        $objMEntrada = Horariosymarcaciones::findFirst(array($consultaEntrada));
                        $objMSalida = Horariosymarcaciones::findFirst(array($consultaSalida));
                        if(is_object($objMEntrada)&&is_object($objMSalida)){

                            /**
                             * Se reinician todos los valores a objeto de no dejar rastros de los anteriores valores.
                             * Sin embargo, el estado para un día en particular esta ya ELABORADO(2), APROBADO (3) o PLANILLADO (4) ya no se modificará el dato
                             */
                            if($objMEntrada->estado1 ==null||$objMEntrada->estado1 <=1){$objMEntrada->d1 =null;$objMEntrada->calendariolaboral1_id=null;$objMEntrada->estado1 =null;}
                            if($objMEntrada->estado2 ==null||$objMEntrada->estado2 <=1){$objMEntrada->d2 =null;$objMEntrada->calendariolaboral2_id=null;$objMEntrada->estado2 =null;}
                            if($objMEntrada->estado3 ==null||$objMEntrada->estado3 <=1){$objMEntrada->d3 =null;$objMEntrada->calendariolaboral3_id=null;$objMEntrada->estado3 =null;}
                            if($objMEntrada->estado4 ==null||$objMEntrada->estado4 <=1){$objMEntrada->d4 =null;$objMEntrada->calendariolaboral4_id=null;$objMEntrada->estado4 =null;}
                            if($objMEntrada->estado5 ==null||$objMEntrada->estado5 <=1){$objMEntrada->d5 =null;$objMEntrada->calendariolaboral5_id=null;$objMEntrada->estado5 =null;}
                            if($objMEntrada->estado6 ==null||$objMEntrada->estado6 <=1){$objMEntrada->d6 =null;$objMEntrada->calendariolaboral6_id=null;$objMEntrada->estado6 =null;}
                            if($objMEntrada->estado7 ==null||$objMEntrada->estado7 <=1){$objMEntrada->d7 =null;$objMEntrada->calendariolaboral7_id=null;$objMEntrada->estado7 =null;}
                            if($objMEntrada->estado8 ==null||$objMEntrada->estado8 <=1){$objMEntrada->d8 =null;$objMEntrada->calendariolaboral8_id=null;$objMEntrada->estado8 =null;}
                            if($objMEntrada->estado9 ==null||$objMEntrada->estado9 <=1){$objMEntrada->d9 =null;$objMEntrada->calendariolaboral9_id=null;$objMEntrada->estado9 =null;}
                            if($objMEntrada->estado10==null||$objMEntrada->estado10<=1){$objMEntrada->d10=null;$objMEntrada->calendariolaboral10_id=null;$objMEntrada->estado10=null;}
                            if($objMEntrada->estado11==null||$objMEntrada->estado11<=1){$objMEntrada->d11=null;$objMEntrada->calendariolaboral11_id=null;$objMEntrada->estado11=null;}
                            if($objMEntrada->estado12==null||$objMEntrada->estado12<=1){$objMEntrada->d12=null;$objMEntrada->calendariolaboral12_id=null;$objMEntrada->estado12=null;}
                            if($objMEntrada->estado13==null||$objMEntrada->estado13<=1){$objMEntrada->d13=null;$objMEntrada->calendariolaboral13_id=null;$objMEntrada->estado13=null;}
                            if($objMEntrada->estado14==null||$objMEntrada->estado14<=1){$objMEntrada->d14=null;$objMEntrada->calendariolaboral14_id=null;$objMEntrada->estado14=null;}
                            if($objMEntrada->estado15==null||$objMEntrada->estado15<=1){$objMEntrada->d15=null;$objMEntrada->calendariolaboral15_id=null;$objMEntrada->estado15=null;}
                            if($objMEntrada->estado16==null||$objMEntrada->estado16<=1){$objMEntrada->d16=null;$objMEntrada->calendariolaboral16_id=null;$objMEntrada->estado16=null;}
                            if($objMEntrada->estado17==null||$objMEntrada->estado17<=1){$objMEntrada->d17=null;$objMEntrada->calendariolaboral17_id=null;$objMEntrada->estado17=null;}
                            if($objMEntrada->estado18==null||$objMEntrada->estado18<=1){$objMEntrada->d18=null;$objMEntrada->calendariolaboral18_id=null;$objMEntrada->estado18=null;}
                            if($objMEntrada->estado19==null||$objMEntrada->estado19<=1){$objMEntrada->d19=null;$objMEntrada->calendariolaboral19_id=null;$objMEntrada->estado19=null;}
                            if($objMEntrada->estado20==null||$objMEntrada->estado20<=1){$objMEntrada->d20=null;$objMEntrada->calendariolaboral20_id=null;$objMEntrada->estado20=null;}
                            if($objMEntrada->estado21==null||$objMEntrada->estado21<=1){$objMEntrada->d21=null;$objMEntrada->calendariolaboral21_id=null;$objMEntrada->estado21=null;}
                            if($objMEntrada->estado22==null||$objMEntrada->estado22<=1){$objMEntrada->d22=null;$objMEntrada->calendariolaboral22_id=null;$objMEntrada->estado22=null;}
                            if($objMEntrada->estado23==null||$objMEntrada->estado23<=1){$objMEntrada->d23=null;$objMEntrada->calendariolaboral23_id=null;$objMEntrada->estado23=null;}
                            if($objMEntrada->estado24==null||$objMEntrada->estado24<=1){$objMEntrada->d24=null;$objMEntrada->calendariolaboral24_id=null;$objMEntrada->estado24=null;}
                            if($objMEntrada->estado25==null||$objMEntrada->estado25<=1){$objMEntrada->d25=null;$objMEntrada->calendariolaboral25_id=null;$objMEntrada->estado25=null;}
                            if($objMEntrada->estado26==null||$objMEntrada->estado26<=1){$objMEntrada->d26=null;$objMEntrada->calendariolaboral26_id=null;$objMEntrada->estado26=null;}
                            if($objMEntrada->estado27==null||$objMEntrada->estado27<=1){$objMEntrada->d27=null;$objMEntrada->calendariolaboral27_id=null;$objMEntrada->estado27=null;}
                            if($objMEntrada->estado28==null||$objMEntrada->estado28<=1){$objMEntrada->d28=null;$objMEntrada->calendariolaboral28_id=null;$objMEntrada->estado28=null;}
                            if($objMEntrada->estado29==null||$objMEntrada->estado29<=1){$objMEntrada->d29=null;$objMEntrada->calendariolaboral29_id=null;$objMEntrada->estado29=null;}
                            if($objMEntrada->estado30==null||$objMEntrada->estado30<=1){$objMEntrada->d30=null;$objMEntrada->calendariolaboral30_id=null;$objMEntrada->estado30=null;}
                            if($objMEntrada->estado31==null||$objMEntrada->estado31<=1){$objMEntrada->d31=null;$objMEntrada->calendariolaboral31_id=null;$objMEntrada->estado31=null;}

                            if($objMSalida->estado1 ==null||$objMSalida->estado1 <=1){$objMSalida->d1 =null;$objMSalida->calendariolaboral1_id=null;$objMSalida->estado1 =null;}
                            if($objMSalida->estado2 ==null||$objMSalida->estado2 <=1){$objMSalida->d2 =null;$objMSalida->calendariolaboral2_id=null;$objMSalida->estado2 =null;}
                            if($objMSalida->estado3 ==null||$objMSalida->estado3 <=1){$objMSalida->d3 =null;$objMSalida->calendariolaboral3_id=null;$objMSalida->estado3 =null;}
                            if($objMSalida->estado4 ==null||$objMSalida->estado4 <=1){$objMSalida->d4 =null;$objMSalida->calendariolaboral4_id=null;$objMSalida->estado4 =null;}
                            if($objMSalida->estado5 ==null||$objMSalida->estado5 <=1){$objMSalida->d5 =null;$objMSalida->calendariolaboral5_id=null;$objMSalida->estado5 =null;}
                            if($objMSalida->estado6 ==null||$objMSalida->estado6 <=1){$objMSalida->d6 =null;$objMSalida->calendariolaboral6_id=null;$objMSalida->estado6 =null;}
                            if($objMSalida->estado7 ==null||$objMSalida->estado7 <=1){$objMSalida->d7 =null;$objMSalida->calendariolaboral7_id=null;$objMSalida->estado7 =null;}
                            if($objMSalida->estado8 ==null||$objMSalida->estado8 <=1){$objMSalida->d8 =null;$objMSalida->calendariolaboral8_id=null;$objMSalida->estado8 =null;}
                            if($objMSalida->estado9 ==null||$objMSalida->estado9 <=1){$objMSalida->d9 =null;$objMSalida->calendariolaboral9_id=null;$objMSalida->estado9 =null;}
                            if($objMSalida->estado10==null||$objMSalida->estado10<=1){$objMSalida->d10=null;$objMSalida->calendariolaboral10_id=null;$objMSalida->estado10=null;}
                            if($objMSalida->estado11==null||$objMSalida->estado11<=1){$objMSalida->d11=null;$objMSalida->calendariolaboral11_id=null;$objMSalida->estado11=null;}
                            if($objMSalida->estado12==null||$objMSalida->estado12<=1){$objMSalida->d12=null;$objMSalida->calendariolaboral12_id=null;$objMSalida->estado12=null;}
                            if($objMSalida->estado13==null||$objMSalida->estado13<=1){$objMSalida->d13=null;$objMSalida->calendariolaboral13_id=null;$objMSalida->estado13=null;}
                            if($objMSalida->estado14==null||$objMSalida->estado14<=1){$objMSalida->d14=null;$objMSalida->calendariolaboral14_id=null;$objMSalida->estado14=null;}
                            if($objMSalida->estado15==null||$objMSalida->estado15<=1){$objMSalida->d15=null;$objMSalida->calendariolaboral15_id=null;$objMSalida->estado15=null;}
                            if($objMSalida->estado16==null||$objMSalida->estado16<=1){$objMSalida->d16=null;$objMSalida->calendariolaboral16_id=null;$objMSalida->estado16=null;}
                            if($objMSalida->estado17==null||$objMSalida->estado17<=1){$objMSalida->d17=null;$objMSalida->calendariolaboral17_id=null;$objMSalida->estado17=null;}
                            if($objMSalida->estado18==null||$objMSalida->estado18<=1){$objMSalida->d18=null;$objMSalida->calendariolaboral18_id=null;$objMSalida->estado18=null;}
                            if($objMSalida->estado19==null||$objMSalida->estado19<=1){$objMSalida->d19=null;$objMSalida->calendariolaboral19_id=null;$objMSalida->estado19=null;}
                            if($objMSalida->estado20==null||$objMSalida->estado20<=1){$objMSalida->d20=null;$objMSalida->calendariolaboral20_id=null;$objMSalida->estado20=null;}
                            if($objMSalida->estado21==null||$objMSalida->estado21<=1){$objMSalida->d21=null;$objMSalida->calendariolaboral21_id=null;$objMSalida->estado21=null;}
                            if($objMSalida->estado22==null||$objMSalida->estado22<=1){$objMSalida->d22=null;$objMSalida->calendariolaboral22_id=null;$objMSalida->estado22=null;}
                            if($objMSalida->estado23==null||$objMSalida->estado23<=1){$objMSalida->d23=null;$objMSalida->calendariolaboral23_id=null;$objMSalida->estado23=null;}
                            if($objMSalida->estado24==null||$objMSalida->estado24<=1){$objMSalida->d24=null;$objMSalida->calendariolaboral24_id=null;$objMSalida->estado24=null;}
                            if($objMSalida->estado25==null||$objMSalida->estado25<=1){$objMSalida->d25=null;$objMSalida->calendariolaboral25_id=null;$objMSalida->estado25=null;}
                            if($objMSalida->estado26==null||$objMSalida->estado26<=1){$objMSalida->d26=null;$objMSalida->calendariolaboral26_id=null;$objMSalida->estado26=null;}
                            if($objMSalida->estado27==null||$objMSalida->estado27<=1){$objMSalida->d27=null;$objMSalida->calendariolaboral27_id=null;$objMSalida->estado27=null;}
                            if($objMSalida->estado28==null||$objMSalida->estado28<=1){$objMSalida->d28=null;$objMSalida->calendariolaboral28_id=null;$objMSalida->estado28=null;}
                            if($objMSalida->estado29==null||$objMSalida->estado29<=1){$objMSalida->d29=null;$objMSalida->calendariolaboral29_id=null;$objMSalida->estado29=null;}
                            if($objMSalida->estado30==null||$objMSalida->estado30<=1){$objMSalida->d30=null;$objMSalida->calendariolaboral30_id=null;$objMSalida->estado30=null;}
                            if($objMSalida->estado31==null||$objMSalida->estado31<=1){$objMSalida->d31=null;$objMSalida->calendariolaboral31_id=null;$objMSalida->estado31=null;}

                            foreach($rangoFechas as $rango){
                                $cal = Calendarioslaborales::find(array("perfillaboral_id=".$v->id_perfillaboral." AND horariolaboral_id=".$v->id_horariolaboral." AND '".$rango->fecha."' BETWEEN fecha_ini AND fecha_fin AND estado>=1 AND baja_logica=1"));
                                if($cal->count()>0){
                                    foreach($cal as $cl){
                                        $arrFecha= explode("-",$rango->fecha);
                                        $dia = intval($arrFecha[2]);
                                        switch($dia){
                                            case 1 :if($objMEntrada->estado1 ==null&&(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3)){$objMEntrada->calendariolaboral1_id=$cl->id; $objMEntrada->estado1 =1;$objMEntrada->d1 =$v->hora_entrada;}if($objMSalida->estado1 ==null&&(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3)){$objMSalida->calendariolaboral1_id=$cl->id; $objMSalida->estado1 =1;$objMSalida->d1 =$v->hora_salida;}$ultimo_dia=1 ;break;
                                            case 2 :if($objMEntrada->estado2 ==null&&(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3)){$objMEntrada->calendariolaboral2_id=$cl->id; $objMEntrada->estado2 =1;$objMEntrada->d2 =$v->hora_entrada;}if($objMSalida->estado2 ==null&&(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3)){$objMSalida->calendariolaboral2_id=$cl->id; $objMSalida->estado2 =1;$objMSalida->d2 =$v->hora_salida;}$ultimo_dia=2 ;break;
                                            case 3 :if($objMEntrada->estado3 ==null&&(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3)){$objMEntrada->calendariolaboral3_id=$cl->id; $objMEntrada->estado3 =1;$objMEntrada->d3 =$v->hora_entrada;}if($objMSalida->estado3 ==null&&(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3)){$objMSalida->calendariolaboral3_id=$cl->id; $objMSalida->estado3 =1;$objMSalida->d3 =$v->hora_salida;}$ultimo_dia=3 ;break;
                                            case 4 :if($objMEntrada->estado4 ==null&&(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3)){$objMEntrada->calendariolaboral4_id=$cl->id; $objMEntrada->estado4 =1;$objMEntrada->d4 =$v->hora_entrada;}if($objMSalida->estado4 ==null&&(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3)){$objMSalida->calendariolaboral4_id=$cl->id; $objMSalida->estado4 =1;$objMSalida->d4 =$v->hora_salida;}$ultimo_dia=4 ;break;
                                            case 5 :if($objMEntrada->estado5 ==null&&(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3)){$objMEntrada->calendariolaboral5_id=$cl->id; $objMEntrada->estado5 =1;$objMEntrada->d5 =$v->hora_entrada;}if($objMSalida->estado5 ==null&&(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3)){$objMSalida->calendariolaboral5_id=$cl->id; $objMSalida->estado5 =1;$objMSalida->d5 =$v->hora_salida;}$ultimo_dia=5 ;break;
                                            case 6 :if($objMEntrada->estado6 ==null&&(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3)){$objMEntrada->calendariolaboral6_id=$cl->id; $objMEntrada->estado6 =1;$objMEntrada->d6 =$v->hora_entrada;}if($objMSalida->estado6 ==null&&(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3)){$objMSalida->calendariolaboral6_id=$cl->id; $objMSalida->estado6 =1;$objMSalida->d6 =$v->hora_salida;}$ultimo_dia=6 ;break;
                                            case 7 :if($objMEntrada->estado7 ==null&&(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3)){$objMEntrada->calendariolaboral7_id=$cl->id; $objMEntrada->estado7 =1;$objMEntrada->d7 =$v->hora_entrada;}if($objMSalida->estado7 ==null&&(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3)){$objMSalida->calendariolaboral7_id=$cl->id; $objMSalida->estado7 =1;$objMSalida->d7 =$v->hora_salida;}$ultimo_dia=7 ;break;
                                            case 8 :if($objMEntrada->estado8 ==null&&(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3)){$objMEntrada->calendariolaboral8_id=$cl->id; $objMEntrada->estado8 =1;$objMEntrada->d8 =$v->hora_entrada;}if($objMSalida->estado8 ==null&&(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3)){$objMSalida->calendariolaboral8_id=$cl->id; $objMSalida->estado8 =1;$objMSalida->d8 =$v->hora_salida;}$ultimo_dia=8 ;break;
                                            case 9 :if($objMEntrada->estado9 ==null&&(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3)){$objMEntrada->calendariolaboral9_id=$cl->id; $objMEntrada->estado9 =1;$objMEntrada->d9 =$v->hora_entrada;}if($objMSalida->estado9 ==null&&(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3)){$objMSalida->calendariolaboral9_id=$cl->id; $objMSalida->estado9 =1;$objMSalida->d9 =$v->hora_salida;}$ultimo_dia=9 ;break;
                                            case 10:if($objMEntrada->estado10==null&&(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3)){$objMEntrada->calendariolaboral10_id=$cl->id;$objMEntrada->estado10=1;$objMEntrada->d10=$v->hora_entrada;}if($objMSalida->estado10==null&&(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3)){$objMSalida->calendariolaboral10_id=$cl->id;$objMSalida->estado10=1;$objMSalida->d10=$v->hora_salida;}$ultimo_dia=10;break;
                                            case 11:if($objMEntrada->estado11==null&&(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3)){$objMEntrada->calendariolaboral11_id=$cl->id;$objMEntrada->estado11=1;$objMEntrada->d11=$v->hora_entrada;}if($objMSalida->estado11==null&&(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3)){$objMSalida->calendariolaboral11_id=$cl->id;$objMSalida->estado11=1;$objMSalida->d11=$v->hora_salida;}$ultimo_dia=11;break;
                                            case 12:if($objMEntrada->estado12==null&&(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3)){$objMEntrada->calendariolaboral12_id=$cl->id;$objMEntrada->estado12=1;$objMEntrada->d12=$v->hora_entrada;}if($objMSalida->estado12==null&&(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3)){$objMSalida->calendariolaboral12_id=$cl->id;$objMSalida->estado12=1;$objMSalida->d12=$v->hora_salida;}$ultimo_dia=12;break;
                                            case 13:if($objMEntrada->estado13==null&&(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3)){$objMEntrada->calendariolaboral13_id=$cl->id;$objMEntrada->estado13=1;$objMEntrada->d13=$v->hora_entrada;}if($objMSalida->estado13==null&&(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3)){$objMSalida->calendariolaboral13_id=$cl->id;$objMSalida->estado13=1;$objMSalida->d13=$v->hora_salida;}$ultimo_dia=13;break;
                                            case 14:if($objMEntrada->estado14==null&&(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3)){$objMEntrada->calendariolaboral14_id=$cl->id;$objMEntrada->estado14=1;$objMEntrada->d14=$v->hora_entrada;}if($objMSalida->estado14==null&&(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3)){$objMSalida->calendariolaboral14_id=$cl->id;$objMSalida->estado14=1;$objMSalida->d14=$v->hora_salida;}$ultimo_dia=14;break;
                                            case 15:if($objMEntrada->estado15==null&&(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3)){$objMEntrada->calendariolaboral15_id=$cl->id;$objMEntrada->estado15=1;$objMEntrada->d15=$v->hora_entrada;}if($objMSalida->estado15==null&&(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3)){$objMSalida->calendariolaboral15_id=$cl->id;$objMSalida->estado15=1;$objMSalida->d15=$v->hora_salida;}$ultimo_dia=15;break;
                                            case 16:if($objMEntrada->estado16==null&&(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3)){$objMEntrada->calendariolaboral16_id=$cl->id;$objMEntrada->estado16=1;$objMEntrada->d16=$v->hora_entrada;}if($objMSalida->estado16==null&&(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3)){$objMSalida->calendariolaboral16_id=$cl->id;$objMSalida->estado16=1;$objMSalida->d16=$v->hora_salida;}$ultimo_dia=16;break;
                                            case 17:if($objMEntrada->estado17==null&&(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3)){$objMEntrada->calendariolaboral17_id=$cl->id;$objMEntrada->estado17=1;$objMEntrada->d17=$v->hora_entrada;}if($objMSalida->estado17==null&&(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3)){$objMSalida->calendariolaboral17_id=$cl->id;$objMSalida->estado17=1;$objMSalida->d17=$v->hora_salida;}$ultimo_dia=17;break;
                                            case 18:if($objMEntrada->estado18==null&&(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3)){$objMEntrada->calendariolaboral18_id=$cl->id;$objMEntrada->estado18=1;$objMEntrada->d18=$v->hora_entrada;}if($objMSalida->estado18==null&&(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3)){$objMSalida->calendariolaboral18_id=$cl->id;$objMSalida->estado18=1;$objMSalida->d18=$v->hora_salida;}$ultimo_dia=18;break;
                                            case 19:if($objMEntrada->estado19==null&&(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3)){$objMEntrada->calendariolaboral19_id=$cl->id;$objMEntrada->estado19=1;$objMEntrada->d19=$v->hora_entrada;}if($objMSalida->estado19==null&&(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3)){$objMSalida->calendariolaboral19_id=$cl->id;$objMSalida->estado19=1;$objMSalida->d19=$v->hora_salida;}$ultimo_dia=19;break;
                                            case 20:if($objMEntrada->estado20==null&&(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3)){$objMEntrada->calendariolaboral20_id=$cl->id;$objMEntrada->estado20=1;$objMEntrada->d20=$v->hora_entrada;}if($objMSalida->estado20==null&&(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3)){$objMSalida->calendariolaboral20_id=$cl->id;$objMSalida->estado20=1;$objMSalida->d20=$v->hora_salida;}$ultimo_dia=20;break;
                                            case 21:if($objMEntrada->estado21==null&&(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3)){$objMEntrada->calendariolaboral21_id=$cl->id;$objMEntrada->estado21=1;$objMEntrada->d21=$v->hora_entrada;}if($objMSalida->estado21==null&&(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3)){$objMSalida->calendariolaboral21_id=$cl->id;$objMSalida->estado21=1;$objMSalida->d21=$v->hora_salida;}$ultimo_dia=21;break;
                                            case 22:if($objMEntrada->estado22==null&&(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3)){$objMEntrada->calendariolaboral22_id=$cl->id;$objMEntrada->estado22=1;$objMEntrada->d22=$v->hora_entrada;}if($objMSalida->estado22==null&&(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3)){$objMSalida->calendariolaboral22_id=$cl->id;$objMSalida->estado22=1;$objMSalida->d22=$v->hora_salida;}$ultimo_dia=22;break;
                                            case 23:if($objMEntrada->estado23==null&&(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3)){$objMEntrada->calendariolaboral23_id=$cl->id;$objMEntrada->estado23=1;$objMEntrada->d23=$v->hora_entrada;}if($objMSalida->estado23==null&&(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3)){$objMSalida->calendariolaboral23_id=$cl->id;$objMSalida->estado23=1;$objMSalida->d23=$v->hora_salida;}$ultimo_dia=23;break;
                                            case 24:if($objMEntrada->estado24==null&&(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3)){$objMEntrada->calendariolaboral24_id=$cl->id;$objMEntrada->estado24=1;$objMEntrada->d24=$v->hora_entrada;}if($objMSalida->estado24==null&&(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3)){$objMSalida->calendariolaboral24_id=$cl->id;$objMSalida->estado24=1;$objMSalida->d24=$v->hora_salida;}$ultimo_dia=24;break;
                                            case 25:if($objMEntrada->estado25==null&&(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3)){$objMEntrada->calendariolaboral25_id=$cl->id;$objMEntrada->estado25=1;$objMEntrada->d25=$v->hora_entrada;}if($objMSalida->estado25==null&&(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3)){$objMSalida->calendariolaboral25_id=$cl->id;$objMSalida->estado25=1;$objMSalida->d25=$v->hora_salida;}$ultimo_dia=25;break;
                                            case 26:if($objMEntrada->estado26==null&&(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3)){$objMEntrada->calendariolaboral26_id=$cl->id;$objMEntrada->estado26=1;$objMEntrada->d26=$v->hora_entrada;}if($objMSalida->estado26==null&&(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3)){$objMSalida->calendariolaboral26_id=$cl->id;$objMSalida->estado26=1;$objMSalida->d26=$v->hora_salida;}$ultimo_dia=26;break;
                                            case 27:if($objMEntrada->estado27==null&&(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3)){$objMEntrada->calendariolaboral27_id=$cl->id;$objMEntrada->estado27=1;$objMEntrada->d27=$v->hora_entrada;}if($objMSalida->estado27==null&&(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3)){$objMSalida->calendariolaboral27_id=$cl->id;$objMSalida->estado27=1;$objMSalida->d27=$v->hora_salida;}$ultimo_dia=27;break;
                                            case 28:if($objMEntrada->estado28==null&&(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3)){$objMEntrada->calendariolaboral28_id=$cl->id;$objMEntrada->estado28=1;$objMEntrada->d28=$v->hora_entrada;}if($objMSalida->estado28==null&&(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3)){$objMSalida->calendariolaboral28_id=$cl->id;$objMSalida->estado28=1;$objMSalida->d28=$v->hora_salida;}$ultimo_dia=28;break;
                                            case 29:if($objMEntrada->estado29==null&&(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3)){$objMEntrada->calendariolaboral29_id=$cl->id;$objMEntrada->estado29=1;$objMEntrada->d29=$v->hora_entrada;}if($objMSalida->estado29==null&&(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3)){$objMSalida->calendariolaboral29_id=$cl->id;$objMSalida->estado29=1;$objMSalida->d29=$v->hora_salida;}$ultimo_dia=29;break;
                                            case 30:if($objMEntrada->estado30==null&&(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3)){$objMEntrada->calendariolaboral30_id=$cl->id;$objMEntrada->estado30=1;$objMEntrada->d30=$v->hora_entrada;}if($objMSalida->estado30==null&&(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3)){$objMSalida->calendariolaboral30_id=$cl->id;$objMSalida->estado30=1;$objMSalida->d30=$v->hora_salida;}$ultimo_dia=30;break;
                                            case 31:if($objMEntrada->estado31==null&&(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3)){$objMEntrada->calendariolaboral31_id=$cl->id;$objMEntrada->estado31=1;$objMEntrada->d31=$v->hora_entrada;}if($objMSalida->estado31==null&&(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3)){$objMSalida->calendariolaboral31_id=$cl->id;$objMSalida->estado31=1;$objMSalida->d31=$v->hora_salida;}$ultimo_dia=31;break;
                                        }
                                    }
                                }
                            }
                            $objMEntrada->ultimo_dia=$ultimo_dia;$objMSalida->ultimo_dia=$ultimo_dia;
                            $objMEntrada->estado=1;$objMSalida->estado=1;
                            $objMEntrada->baja_logica=1;$objMSalida->baja_logica=1;
                            $objMEntrada->agrupador=0;$objMSalida->agrupador=0;
                            $objMEntrada->user_mod_id=$user_mod_id;$objMSalida->user_mod_id=$user_mod_id;
                            $objMEntrada->fecha_mod=$hoy;$objMSalida->fecha_mod=$hoy;
                            try{
                                $okE = $objMEntrada->save();
                                $okS = $objMSalida->save();
                                if ($okS)  {
                                    $msj = array('result' => 1, 'msj' => '&Eacute;xito: El detalle correspondiente a los registros previstos de marcaci&oacute;n se volvieron a generar correctamente.');
                                } else {
                                    $msj = array('result' => 0, 'msj' => 'Error: No se modific&oacute; el detalle correspondiente a los registro previstos de marcación.');
                                }
                            }catch (\Exception $e) {
                                echo get_class($e), ": ", $e->getMessage(), "\n";
                                echo " File=", $e->getFile(), "\n";
                                echo " Line=", $e->getLine(), "\n";
                                echo $e->getTraceAsString();
                                $msj = array('result' => -1, 'msj' => 'Error cr&iacute;tico: No se modific&oacute; el detalle correspondiente a registros previstos de marcaci&oacute;n.');
                            }
                        }else{
                            $msj = array('result' => 0, 'msj' => 'Error: No se modific&oacute; el detalle correspondiente a los registro previstos de marcación debido a que no se hall&oacute; los registros correspondientes en la base de datos.');
                        }
                        #endregion Estableciendo los valores para las variables del objeto
                    }
                }
            }
            else{
                $msj = array('result' => 0, 'msj' => 'Error: No se gener&oacute; el registro de marcaciones debido a que no se encontr&oacute; registros de calendarizaci&oacute;n para el mes solicitado.');
            }
            #endregion Edición de Registro
        }else{
            if(isset($_POST["id_relaboral"])&&$_POST["id_relaboral"]>0&&isset($_POST["gestion"])&&isset($_POST["mes"])&&isset($_POST["clasemarcacion"])){
                #region Nuevo Registro
                $idRelaboral = $_POST["id_relaboral"];
                $gestion = $_POST["gestion"];
                $mes = $_POST["mes"];
                $fechaIni = $_POST["fecha_ini"];
                $fechaFin = $_POST["fecha_fin"];
                $clasemarcacion = $_POST["clasemarcacion"];
                $objCL = new Fcalendariolaboral();
                $turno = 0;
                $grupo = 0;
                /**
                 * Se obtiene el listado de calendarios registrados para los perfiles correspondientes al registro de relación laboral
                 */
                $resul = $objCL->getAllRegisteredByPerfilAndRelaboralRangoFechas(0,$idRelaboral,$fechaIni,$fechaFin);
                if ($resul->count() > 0) {
                    foreach ($resul as $v) {
                        $objMEntrada = new Horariosymarcaciones();
                        $objMSalida = new Horariosymarcaciones();
                        $tipo_horario = $v->tipo_horario;
                        $turno++;
                        $grupo++;
                        $ultimo_dia=0;
                        $objRango = new Ffechasrango();
                        $rangoFechas = $objRango->getAll($fechaIni,$fechaFin);
                        if ($rangoFechas->count() > 0) {
                            #region Estableciendo los valores para las variables del objeto
                            $objMEntrada->relaboral_id=$idRelaboral;$objMSalida->relaboral_id=$idRelaboral;
                            $objMEntrada->gestion=$gestion;$objMSalida->gestion=$gestion;
                            $objMEntrada->mes=$mes;$objMSalida->mes=$mes;
                            $objMEntrada->turno=$turno;$objMSalida->turno=$turno;
                            $objMEntrada->grupo=$grupo;$grupo++;$objMSalida->grupo=$grupo;
                            $objMEntrada->clasemarcacion=$clasemarcacion;$objMSalida->clasemarcacion=$clasemarcacion;
                            switch($clasemarcacion){
                                case 'H':
                                    $objMEntrada->modalidadmarcacion_id=1;
                                    $objMSalida->modalidadmarcacion_id=4;
                                    break;
                                case 'M':
                                    $objMEntrada->modalidadmarcacion_id=2;
                                    $objMSalida->modalidadmarcacion_id=5;
                                    break;
                                case 'R':
                                    $objMEntrada->modalidadmarcacion_id=3;
                                    $objMSalida->modalidadmarcacion_id=6;
                                    break;
                                case 'A':
                                    break;
                            }
                            foreach($rangoFechas as $rango){
                                $cal = Calendarioslaborales::find(array("perfillaboral_id=".$v->id_perfillaboral." AND horariolaboral_id=".$v->id_horariolaboral." AND '".$rango->fecha."' BETWEEN fecha_ini AND fecha_fin AND estado>=1 AND baja_logica=1"));
                                if($cal->count()>0){
                                    foreach($cal as $cl){
                                        /**
                                         * Al perfil se le ha asignado una calendarización para esa fecha
                                         */
                                        $arrFecha= explode("-",$rango->fecha);
                                        $dia = intval($arrFecha[2]);
                                        $objME = new Marcaciones();
                                        $objMS = new Marcaciones();
                                        $horaMarcacionEntrada=null;
                                        $horaMarcacionSalida=null;
                                        $resultE = $objME->getOneMarcacionValida(0,$idRelaboral,$rango->fecha,$v->hora_inicio_rango_ent,$v->hora_final_rango_ent);
                                        $resultS = $objMS->getOneMarcacionValida(0,$idRelaboral,$rango->fecha,$v->hora_inicio_rango_sal,$v->hora_final_rango_sal);
                                        /*$resultE = $objME->getMarcacionValida(0,$idRelaboral,$rango->fecha,$v->hora_inicio_rango_ent,$v->hora_final_rango_ent);
                                        $resultS = $objMS->getMarcacionValida(0,$idRelaboral,$rango->fecha,$v->hora_inicio_rango_sal,$v->hora_final_rango_sal);*/

                                        if(is_object($resultE)){
                                            foreach($resultE as $obe){
                                                $horaMarcacionEntrada = $obe->hora;
                                            }
                                        }else{
                                            $horaMarcacionEntrada=null;
                                        }
                                        if(is_object($resultS)){
                                            foreach($resultS as $obs){
                                                $horaMarcacionSalida = $obs->hora;
                                            }
                                        }else{
                                            $horaMarcacionSalida=null;
                                        }
                                        //echo "<p>\n-->fecha: ".$rango->fecha." -> ".$horaMarcacionEntrada."-".$horaMarcacionSalida;
                                        switch($dia){
                                            case 1 :if(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3){$objMEntrada->calendariolaboral1_id=$cl->id; $objMEntrada->estado1 =1;$objMEntrada->d1 =$horaMarcacionEntrada;$objMSalida->calendariolaboral1_id=$cl->id; $objMSalida->estado1 =1;$objMSalida->d1 =$horaMarcacionSalida;}$ultimo_dia=1 ;break;
                                            case 2 :if(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3){$objMEntrada->calendariolaboral2_id=$cl->id; $objMEntrada->estado2 =1;$objMEntrada->d2 =$horaMarcacionEntrada;$objMSalida->calendariolaboral2_id=$cl->id; $objMSalida->estado2 =1;$objMSalida->d2 =$horaMarcacionSalida;}$ultimo_dia=2 ;break;
                                            case 3 :if(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3){$objMEntrada->calendariolaboral3_id=$cl->id; $objMEntrada->estado3 =1;$objMEntrada->d3 =$horaMarcacionEntrada;$objMSalida->calendariolaboral3_id=$cl->id; $objMSalida->estado3 =1;$objMSalida->d3 =$horaMarcacionSalida;}$ultimo_dia=3 ;break;
                                            case 4 :if(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3){$objMEntrada->calendariolaboral4_id=$cl->id; $objMEntrada->estado4 =1;$objMEntrada->d4 =$horaMarcacionEntrada;$objMSalida->calendariolaboral4_id=$cl->id; $objMSalida->estado4 =1;$objMSalida->d4 =$horaMarcacionSalida;}$ultimo_dia=4 ;break;
                                            case 5 :if(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3){$objMEntrada->calendariolaboral5_id=$cl->id; $objMEntrada->estado5 =1;$objMEntrada->d5 =$horaMarcacionEntrada;$objMSalida->calendariolaboral5_id=$cl->id; $objMSalida->estado5 =1;$objMSalida->d5 =$horaMarcacionSalida;}$ultimo_dia=5 ;break;
                                            case 6 :if(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3){$objMEntrada->calendariolaboral6_id=$cl->id; $objMEntrada->estado6 =1;$objMEntrada->d6 =$horaMarcacionEntrada;$objMSalida->calendariolaboral6_id=$cl->id; $objMSalida->estado6 =1;$objMSalida->d6 =$horaMarcacionSalida;}$ultimo_dia=6 ;break;
                                            case 7 :if(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3){$objMEntrada->calendariolaboral7_id=$cl->id; $objMEntrada->estado7 =1;$objMEntrada->d7 =$horaMarcacionEntrada;$objMSalida->calendariolaboral7_id=$cl->id; $objMSalida->estado7 =1;$objMSalida->d7 =$horaMarcacionSalida;}$ultimo_dia=7 ;break;
                                            case 8 :if(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3){$objMEntrada->calendariolaboral8_id=$cl->id; $objMEntrada->estado8 =1;$objMEntrada->d8 =$horaMarcacionEntrada;$objMSalida->calendariolaboral8_id=$cl->id; $objMSalida->estado8 =1;$objMSalida->d8 =$horaMarcacionSalida;}$ultimo_dia=8 ;break;
                                            case 9 :if(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3){$objMEntrada->calendariolaboral9_id=$cl->id; $objMEntrada->estado9 =1;$objMEntrada->d9 =$horaMarcacionEntrada;$objMSalida->calendariolaboral9_id=$cl->id; $objMSalida->estado9 =1;$objMSalida->d9 =$horaMarcacionSalida;}$ultimo_dia=9 ;break;
                                            case 10:if(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3){$objMEntrada->calendariolaboral10_id=$cl->id;$objMEntrada->estado10=1;$objMEntrada->d10=$horaMarcacionEntrada;$objMSalida->calendariolaboral10_id=$cl->id;$objMSalida->estado10=1;$objMSalida->d10=$horaMarcacionSalida;}$ultimo_dia=10;break;
                                            case 11:if(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3){$objMEntrada->calendariolaboral11_id=$cl->id;$objMEntrada->estado11=1;$objMEntrada->d11=$horaMarcacionEntrada;$objMSalida->calendariolaboral11_id=$cl->id;$objMSalida->estado11=1;$objMSalida->d11=$horaMarcacionSalida;}$ultimo_dia=11;break;
                                            case 12:if(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3){$objMEntrada->calendariolaboral12_id=$cl->id;$objMEntrada->estado12=1;$objMEntrada->d12=$horaMarcacionEntrada;$objMSalida->calendariolaboral12_id=$cl->id;$objMSalida->estado12=1;$objMSalida->d12=$horaMarcacionSalida;}$ultimo_dia=12;break;
                                            case 13:if(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3){$objMEntrada->calendariolaboral13_id=$cl->id;$objMEntrada->estado13=1;$objMEntrada->d13=$horaMarcacionEntrada;$objMSalida->calendariolaboral13_id=$cl->id;$objMSalida->estado13=1;$objMSalida->d13=$horaMarcacionSalida;}$ultimo_dia=13;break;
                                            case 14:if(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3){$objMEntrada->calendariolaboral14_id=$cl->id;$objMEntrada->estado14=1;$objMEntrada->d14=$horaMarcacionEntrada;$objMSalida->calendariolaboral14_id=$cl->id;$objMSalida->estado14=1;$objMSalida->d14=$horaMarcacionSalida;}$ultimo_dia=14;break;
                                            case 15:if(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3){$objMEntrada->calendariolaboral15_id=$cl->id;$objMEntrada->estado15=1;$objMEntrada->d15=$horaMarcacionEntrada;$objMSalida->calendariolaboral15_id=$cl->id;$objMSalida->estado15=1;$objMSalida->d15=$horaMarcacionSalida;}$ultimo_dia=15;break;
                                            case 16:if(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3){$objMEntrada->calendariolaboral16_id=$cl->id;$objMEntrada->estado16=1;$objMEntrada->d16=$horaMarcacionEntrada;$objMSalida->calendariolaboral16_id=$cl->id;$objMSalida->estado16=1;$objMSalida->d16=$horaMarcacionSalida;}$ultimo_dia=16;break;
                                            case 17:if(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3){$objMEntrada->calendariolaboral17_id=$cl->id;$objMEntrada->estado17=1;$objMEntrada->d17=$horaMarcacionEntrada;$objMSalida->calendariolaboral17_id=$cl->id;$objMSalida->estado17=1;$objMSalida->d17=$horaMarcacionSalida;}$ultimo_dia=17;break;
                                            case 18:if(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3){$objMEntrada->calendariolaboral18_id=$cl->id;$objMEntrada->estado18=1;$objMEntrada->d18=$horaMarcacionEntrada;$objMSalida->calendariolaboral18_id=$cl->id;$objMSalida->estado18=1;$objMSalida->d18=$horaMarcacionSalida;}$ultimo_dia=18;break;
                                            case 19:if(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3){$objMEntrada->calendariolaboral19_id=$cl->id;$objMEntrada->estado19=1;$objMEntrada->d19=$horaMarcacionEntrada;$objMSalida->calendariolaboral19_id=$cl->id;$objMSalida->estado19=1;$objMSalida->d19=$horaMarcacionSalida;}$ultimo_dia=19;break;
                                            case 20:if(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3){$objMEntrada->calendariolaboral20_id=$cl->id;$objMEntrada->estado20=1;$objMEntrada->d20=$horaMarcacionEntrada;$objMSalida->calendariolaboral20_id=$cl->id;$objMSalida->estado20=1;$objMSalida->d20=$horaMarcacionSalida;}$ultimo_dia=20;break;
                                            case 21:if(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3){$objMEntrada->calendariolaboral21_id=$cl->id;$objMEntrada->estado21=1;$objMEntrada->d21=$horaMarcacionEntrada;$objMSalida->calendariolaboral21_id=$cl->id;$objMSalida->estado21=1;$objMSalida->d21=$horaMarcacionSalida;}$ultimo_dia=21;break;
                                            case 22:if(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3){$objMEntrada->calendariolaboral22_id=$cl->id;$objMEntrada->estado22=1;$objMEntrada->d22=$horaMarcacionEntrada;$objMSalida->calendariolaboral22_id=$cl->id;$objMSalida->estado22=1;$objMSalida->d22=$horaMarcacionSalida;}$ultimo_dia=22;break;
                                            case 23:if(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3){$objMEntrada->calendariolaboral23_id=$cl->id;$objMEntrada->estado23=1;$objMEntrada->d23=$horaMarcacionEntrada;$objMSalida->calendariolaboral23_id=$cl->id;$objMSalida->estado23=1;$objMSalida->d23=$horaMarcacionSalida;}$ultimo_dia=23;break;
                                            case 24:if(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3){$objMEntrada->calendariolaboral24_id=$cl->id;$objMEntrada->estado24=1;$objMEntrada->d24=$horaMarcacionEntrada;$objMSalida->calendariolaboral24_id=$cl->id;$objMSalida->estado24=1;$objMSalida->d24=$horaMarcacionSalida;}$ultimo_dia=24;break;
                                            case 25:if(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3){$objMEntrada->calendariolaboral25_id=$cl->id;$objMEntrada->estado25=1;$objMEntrada->d25=$horaMarcacionEntrada;$objMSalida->calendariolaboral25_id=$cl->id;$objMSalida->estado25=1;$objMSalida->d25=$horaMarcacionSalida;}$ultimo_dia=25;break;
                                            case 26:if(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3){$objMEntrada->calendariolaboral26_id=$cl->id;$objMEntrada->estado26=1;$objMEntrada->d26=$horaMarcacionEntrada;$objMSalida->calendariolaboral26_id=$cl->id;$objMSalida->estado26=1;$objMSalida->d26=$horaMarcacionSalida;}$ultimo_dia=26;break;
                                            case 27:if(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3){$objMEntrada->calendariolaboral27_id=$cl->id;$objMEntrada->estado27=1;$objMEntrada->d27=$horaMarcacionEntrada;$objMSalida->calendariolaboral27_id=$cl->id;$objMSalida->estado27=1;$objMSalida->d27=$horaMarcacionSalida;}$ultimo_dia=27;break;
                                            case 28:if(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3){$objMEntrada->calendariolaboral28_id=$cl->id;$objMEntrada->estado28=1;$objMEntrada->d28=$horaMarcacionEntrada;$objMSalida->calendariolaboral28_id=$cl->id;$objMSalida->estado28=1;$objMSalida->d28=$horaMarcacionSalida;}$ultimo_dia=28;break;
                                            case 29:if(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3){$objMEntrada->calendariolaboral29_id=$cl->id;$objMEntrada->estado29=1;$objMEntrada->d29=$horaMarcacionEntrada;$objMSalida->calendariolaboral29_id=$cl->id;$objMSalida->estado29=1;$objMSalida->d29=$horaMarcacionSalida;}$ultimo_dia=29;break;
                                            case 30:if(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3){$objMEntrada->calendariolaboral30_id=$cl->id;$objMEntrada->estado30=1;$objMEntrada->d30=$horaMarcacionEntrada;$objMSalida->calendariolaboral30_id=$cl->id;$objMSalida->estado30=1;$objMSalida->d30=$horaMarcacionSalida;}$ultimo_dia=30;break;
                                            case 31:if(($tipo_horario!=3&&$rango->dia!=0&&$rango->dia!=6)||$tipo_horario==3){$objMEntrada->calendariolaboral31_id=$cl->id;$objMEntrada->estado31=1;$objMEntrada->d31=$horaMarcacionEntrada;$objMSalida->calendariolaboral31_id=$cl->id;$objMSalida->estado31=1;$objMSalida->d31=$horaMarcacionSalida;}$ultimo_dia=31;break;
                                        }
                                    }
                                }
                            }
                            #endregion Estableciendo los valores para las variables del objeto
                        }
                        $objMEntrada->ultimo_dia=$ultimo_dia;$objMSalida->ultimo_dia=$ultimo_dia;
                        $objMEntrada->estado=1;$objMSalida->estado=1;
                        $objMEntrada->baja_logica=1;$objMSalida->baja_logica=1;
                        $objMEntrada->agrupador=0;$objMSalida->agrupador=0;
                        $objMEntrada->user_reg_id=$user_reg_id;$objMSalida->user_reg_id=$user_reg_id;
                        $objMEntrada->fecha_reg=$hoy;$objMSalida->fecha_reg=$hoy;
                        try{
                            $okE = $objMEntrada->save();
                            $okS = $objMSalida->save();
                            if ($okE&&$okS)  {
                                $msj = array('result' => 1, 'msj' => '&Eacute;xito: El detalle correspondiente a los registros previstos de marcaci&oacute;n fueron generados correctamente.');
                            } else {
                                $msj = array('result' => 0, 'msj' => 'Error: No se guard&oacute; el detalle correspondiente a los registro previstos de marcación.');
                            }
                        }catch (\Exception $e) {
                            echo get_class($e), ": ", $e->getMessage(), "\n";
                            echo " File=", $e->getFile(), "\n";
                            echo " Line=", $e->getLine(), "\n";
                            echo $e->getTraceAsString();
                            $msj = array('result' => -1, 'msj' => 'Error cr&iacute;tico: No se guard&oacute; el detalle correspondiente a registros previstos de marcaci&oacute;n.');
                        }
                    }
                }
                else{
                    $msj = array('result' => 0, 'msj' => 'Error: No se gener&oacute; el registro de marcaciones debido a que no se encontr&oacute; registros de calendarizaci&oacute;n para el mes solicitado.');
                }
                #endregion Nuevo Registro
            }
        }
        echo json_encode($msj);
    }

    /**
     * Función para dar de baja a los registros de horarios de marcación correspondientes a un registro de relación laboral, gestión y mes determinados.
     */
    public function eliminarAction(){
        $this->view->disable();
        $auth = $this->session->get('auth');
        $user_mod_id = $auth['id'];
        $msj = Array();
        $hoy = date("Y-m-d H:i:s");
        $this->view->disable();
        if(isset($_POST["id_relaboral"])&&$_POST["id_relaboral"]>0&&isset($_POST["gestion"])&&$_POST["gestion"]>0&&isset($_POST["gestion"])&&$_POST["mes"]>0){
            $idRelaboral = $_POST["id_relaboral"];
            $gestion = $_POST["gestion"];
            $mes = $_POST["mes"];
            $fechaIni = $_POST["fecha_ini"];
            $fechaFin = $_POST["fecha_fin"];
            $clasemarcacion = $_POST["clasemarcacion"];
            if($clasemarcacion=="H")
            $result = Horariosymarcaciones::find(array("relaboral_id=".$idRelaboral." AND gestion=".$gestion." AND mes=".$mes." AND estado>=1 AND baja_logica=1"));
            else $result = Horariosymarcaciones::find(array("relaboral_id=".$idRelaboral." AND gestion=".$gestion." AND mes=".$mes." AND clasemarcacion='$clasemarcacion' AND estado>=1 AND baja_logica=1"));
            if($result->count()>0){
                $ok2 = true;
                foreach ($result as $val) {
                    $objHM = Horariosymarcaciones::findFirstById($val->id);
                    $objHM->estado=0;
                    $objHM->baja_logica=0;
                    $objHM->user_mod_id=$user_mod_id;
                    $objHM->fecha_mod=$hoy;
                    try{
                        $ok=$objHM->save();
                        if(!$ok){
                            $ok2=false;
                        }
                    }catch (\Exception $e) {
                        echo get_class($e), ": ", $e->getMessage(), "\n";
                        echo " File=", $e->getFile(), "\n";
                        echo " Line=", $e->getLine(), "\n";
                        echo $e->getTraceAsString();
                        $msj = array('result' => -1, 'msj' => 'No se pudo dar de baja a los registros correspondientes debido a un error cr&iacute;tico.');
                    }
                }
                if($ok2){
                    $msj = array('result' => 1, 'msj' => 'Registro de Baja realizado de modo satisfactorio.');
                }else{
                    $msj = array('result' => 0, 'msj' => 'La baja no se efectu&oacute; de forma satisfactoria.');
                }
            }
        }else {
            $msj = array('result' => 0, 'msj' => 'No se pudo dar de baja a los registros solicitados.');
        }
        echo json_encode($msj);
    }

} 