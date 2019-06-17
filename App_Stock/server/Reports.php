<?php

    @$_dtMin = $_GET['_dtMin']; // data de aquisição miníma
    @$_dtMax = $_GET['_dtMax']; // data de aquisição máxima
    @$material = $_GET['material'];
    @$supplier = $_GET['supplier'];
    @$_avgUcMin = $_GET['_avgUcMin']; // média miníma de custo unitário
    @$_avgUcMax = $_GET['_avgUcMax']; // média máxima de custo unitário

    include_once 'db/conn.php';

    if(($material != '' && $material != false) || ($supplier != '' && $supplier != false) || ($_dtMin != '' && $_dtMin != false) || ($_dtMax != '' && $_dtMax != false) || ($_avgUcMin != '' && $_avgUcMin != false) || ($_avgUcMax != '' && $_avgUcMax != false)) {
        
        $select = '';
        $from = ' FROM MATERIAL_STANDARDS M 
                 INNER JOIN PURCHASED P ON M.ID_MATERIAL = P.ID_MATERIAL
                 INNER JOIN SUPPLIER S ON P.ID_SUPPLIER = S.ID_SUPPLIER ';
        $conditions = '';
        $groupBy = ' GROUP BY P.ID_MATERIAL ';
        $having = '';
        $orderBy = ' ORDER BY M.NAME ASC ';
                
        if($material != '' && $material != false){
            // Tem Material no select
            $conditions .= ' WHERE M.NAME LIKE UPPER("%' . $material . '%") ';
            
            if($supplier != '' && $supplier != false){
                // Tem Supplier no select, define select
                $select = 'SELECT P.ID_MATERIAL, P.ID_SUPPLIER, M.NAME AS MATERIAL, S.NAME AS SUPPLIER, FORMAT (SUM(P.QUANTITY), 0) AS QT_TOTAL, FORMAT (AVG(P.UNIT_COST), 2) AS AVG_UNIT_COST ';
                $conditions .= ' AND S.NAME LIKE UPPER("%' . $supplier . '%") ' ;
                
                if($_dtMin != '' && $_dtMin != false){
                    if($_dtMax != '' && $_dtMax != false){
                        $conditions .= ' AND P.PURCHASE_DATE BETWEEN "' . $_dtMin . ' 00:00:00" AND "' . $_dtMax . ' 23:59:59" ';
                        
                        if($_avgUcMin != '' && $_avgUcMin != false){
                            // Tem custo unitário médio, define HAVING                                
                            if($_avgUcMax != '' && $_avgUcMax != false){
                                $having = ' HAVING AVG_UNIT_COST BETWEEN ' . $_avgUcMin . ' AND ' . $_avgUcMax . ' ';
                            } else {
                                $having = ' HAVING AVG_UNIT_COST >= ' . $_avgUcMin . ' ';
                            }
                        } else {
                            if($_avgUcMax != '' && $_avgUcMax != false){
                                $having = ' HAVING AVG_UNIT_COST <= ' . $_avgUcMax . ' ';
                            }
                        }
                    } else {
                        $conditions .= ' AND P.PURCHASE_DATE >= "' . $_dtMin . ' 00:00:00" ';
                        
                        if($_avgUcMin != '' && $_avgUcMin != false){
                            // Tem custo unitário médio, define HAVING                                
                            if($_avgUcMax != '' && $_avgUcMax != false){
                                $having = ' HAVING AVG_UNIT_COST BETWEEN ' . $_avgUcMin . ' AND ' . $_avgUcMax . ' ';
                            } else {
                                $having = ' HAVING AVG_UNIT_COST >= ' . $_avgUcMin . ' ';
                            }
                        } else {
                            if($_avgUcMax != '' && $_avgUcMax != false){
                                $having = ' HAVING AVG_UNIT_COST <= ' . $_avgUcMax . ' ';
                            }
                        }
                    }
                } else {
                    if($_dtMax != '' && $_dtMax != false){
                        $conditions .= ' AND P.PURCHASE_DATE <= "' . $_dtMax . ' 23:59:59" ';
                        
                        if($_avgUcMin != '' && $_avgUcMin != false){
                            // Tem custo unitário médio, define HAVING                                
                            if($_avgUcMax != '' && $_avgUcMax != false){
                                $having = ' HAVING AVG_UNIT_COST BETWEEN ' . $_avgUcMin . ' AND ' . $_avgUcMax . ' ';
                            } else {
                                $having = ' HAVING AVG_UNIT_COST >= ' . $_avgUcMin . ' ';
                            }
                        } else {
                            if($_avgUcMax != '' && $_avgUcMax != false){
                                $having = ' HAVING AVG_UNIT_COST <= ' . $_avgUcMax . ' ';
                            }
                        }
                    } else {
                        if($_avgUcMin != '' && $_avgUcMin != false){
                            // Tem custo unitário médio, define HAVING                                
                            if($_avgUcMax != '' && $_avgUcMax != false){
                                $having = ' HAVING AVG_UNIT_COST BETWEEN ' . $_avgUcMin . ' AND ' . $_avgUcMax . ' ';
                            } else {
                                $having = ' HAVING AVG_UNIT_COST >= ' . $_avgUcMin . ' ';
                            }
                        } else {
                            if($_avgUcMax != '' && $_avgUcMax != false){
                                $having = ' HAVING AVG_UNIT_COST <= ' . $_avgUcMax . ' ';
                            }
                        }
                    }
                }
            } else {
                // Não tem supplier, define select
                $select = 'SELECT P.ID_MATERIAL, M.NAME AS MATERIAL, FORMAT (SUM(P.QUANTITY), 0) AS QT_TOTAL, FORMAT (AVG(P.UNIT_COST), 2) AS AVG_UNIT_COST ';
                
                if($_dtMin != '' && $_dtMin != false){
                    if($_dtMax != '' && $_dtMax != false){
                        $conditions .= ' AND P.PURCHASE_DATE BETWEEN "' . $_dtMin . ' 00:00:00" AND "' . $_dtMax . ' 23:59:59" ';
                        
                        if($_avgUcMin != '' && $_avgUcMin != false){
                            // Tem custo unitário médio, define HAVING                                
                            if($_avgUcMax != '' && $_avgUcMax != false){
                                $having = ' HAVING AVG_UNIT_COST BETWEEN ' . $_avgUcMin . ' AND ' . $_avgUcMax . ' ';
                            } else {
                                $having = ' HAVING AVG_UNIT_COST >= ' . $_avgUcMin . ' ';
                            }
                        } else {
                            if($_avgUcMax != '' && $_avgUcMax != false){
                                $having = ' HAVING AVG_UNIT_COST <= ' . $_avgUcMax . ' ';
                            }
                        }
                    } else {
                        $conditions .= ' AND P.PURCHASE_DATE >= "' . $_dtMin . ' 00:00:00" ';
                        
                        if($_avgUcMin != '' && $_avgUcMin != false){
                            // Tem custo unitário médio, define HAVING                                
                            if($_avgUcMax != '' && $_avgUcMax != false){
                                $having = ' HAVING AVG_UNIT_COST BETWEEN ' . $_avgUcMin . ' AND ' . $_avgUcMax . ' ';
                            } else {
                                $having = ' HAVING AVG_UNIT_COST >= ' . $_avgUcMin . ' ';
                            }
                        } else {
                            if($_avgUcMax != '' && $_avgUcMax != false){
                                $having = ' HAVING AVG_UNIT_COST <= ' . $_avgUcMax . ' ';
                            }
                        }
                    }
                } else {
                    if($_dtMax != '' && $_dtMax != false){
                        $conditions .= ' AND P.PURCHASE_DATE <= "' . $_dtMax . ' 23:59:59" ';
                        
                        if($_avgUcMin != '' && $_avgUcMin != false){
                            // Tem custo unitário médio, define HAVING                                
                            if($_avgUcMax != '' && $_avgUcMax != false){
                                $having = ' HAVING AVG_UNIT_COST BETWEEN ' . $_avgUcMin . ' AND ' . $_avgUcMax . ' ';
                            } else {
                                $having = ' HAVING AVG_UNIT_COST >= ' . $_avgUcMin . ' ';
                            }
                        } else {
                            if($_avgUcMax != '' && $_avgUcMax != false){
                                $having = ' HAVING AVG_UNIT_COST <= ' . $_avgUcMax . ' ';
                            }
                        }
                    } else {
                        if($_avgUcMin != '' && $_avgUcMin != false){
                            // Tem custo unitário médio, define HAVING                                
                            if($_avgUcMax != '' && $_avgUcMax != false){
                                $having = ' HAVING AVG_UNIT_COST BETWEEN ' . $_avgUcMin . ' AND ' . $_avgUcMax . ' ';
                            } else {
                                $having = ' HAVING AVG_UNIT_COST >= ' . $_avgUcMin . ' ';
                            }
                        } else {
                            if($_avgUcMax != '' && $_avgUcMax != false){
                                $having = ' HAVING AVG_UNIT_COST <= ' . $_avgUcMax . ' ';
                            }
                        }
                    }
                }
            }
        } else {
            if($supplier != '' && $supplier != false){
                // Tem Supplier no select, define select
                $select = 'SELECT P.ID_MATERIAL, P.ID_SUPPLIER, M.NAME AS MATERIAL, S.NAME AS SUPPLIER, FORMAT (SUM(P.QUANTITY), 0) AS QT_TOTAL, FORMAT (AVG(P.UNIT_COST), 2) AS AVG_UNIT_COST ';
                $conditions .= ' WHERE S.NAME LIKE UPPER("%' . $supplier . '%") ' ;
                
                if($_dtMin != '' && $_dtMin != false){
                    if($_dtMax != '' && $_dtMax != false){
                        $conditions .= ' AND P.PURCHASE_DATE BETWEEN "' . $_dtMin . ' 00:00:00" AND "' . $_dtMax . ' 23:59:59" ';
                        
                        if($_avgUcMin != '' && $_avgUcMin != false){
                            // Tem custo unitário médio, define HAVING                                
                            if($_avgUcMax != '' && $_avgUcMax != false){
                                $having = ' HAVING AVG_UNIT_COST BETWEEN ' . $_avgUcMin . ' AND ' . $_avgUcMax . ' ';
                            } else {
                                $having = ' HAVING AVG_UNIT_COST >= ' . $_avgUcMin . ' ';
                            }
                        } else {
                            if($_avgUcMax != '' && $_avgUcMax != false){
                                $having = ' HAVING AVG_UNIT_COST <= ' . $_avgUcMax . ' ';
                            }
                        }
                    } else {
                        $conditions .= ' AND P.PURCHASE_DATE >= "' . $_dtMin . ' 00:00:00" ';
                        
                        if($_avgUcMin != '' && $_avgUcMin != false){
                            // Tem custo unitário médio, define HAVING                                
                            if($_avgUcMax != '' && $_avgUcMax != false){
                                $having = ' HAVING AVG_UNIT_COST BETWEEN ' . $_avgUcMin . ' AND ' . $_avgUcMax . ' ';
                            } else {
                                $having = ' HAVING AVG_UNIT_COST >= ' . $_avgUcMin . ' ';
                            }
                        } else {
                            if($_avgUcMax != '' && $_avgUcMax != false){
                                $having = ' HAVING AVG_UNIT_COST <= ' . $_avgUcMax . ' ';
                            }
                        }
                    }
                } else {
                    if($_dtMax != '' && $_dtMax != false){
                        $conditions .= ' AND P.PURCHASE_DATE <= "' . $_dtMax . ' 23:59:59" ';
                        
                        if($_avgUcMin != '' && $_avgUcMin != false){
                            // Tem custo unitário médio, define HAVING                                
                            if($_avgUcMax != '' && $_avgUcMax != false){
                                $having = ' HAVING AVG_UNIT_COST BETWEEN ' . $_avgUcMin . ' AND ' . $_avgUcMax . ' ';
                            } else {
                                $having = ' HAVING AVG_UNIT_COST >= ' . $_avgUcMin . ' ';
                            }
                        } else {
                            if($_avgUcMax != '' && $_avgUcMax != false){
                                $having = ' HAVING AVG_UNIT_COST <= ' . $_avgUcMax . ' ';
                            }
                        }
                    } else {
                        if($_avgUcMin != '' && $_avgUcMin != false){
                            // Tem custo unitário médio, define HAVING                                
                            if($_avgUcMax != '' && $_avgUcMax != false){
                                $having = ' HAVING AVG_UNIT_COST BETWEEN ' . $_avgUcMin . ' AND ' . $_avgUcMax . ' ';
                            } else {
                                $having = ' HAVING AVG_UNIT_COST >= ' . $_avgUcMin . ' ';
                            }
                        } else {
                            if($_avgUcMax != '' && $_avgUcMax != false){
                                $having = ' HAVING AVG_UNIT_COST <= ' . $_avgUcMax . ' ';
                            }
                        }
                    }
                }
            } else {
                // Não tem supplier, define select
                $select = 'SELECT P.ID_MATERIAL, M.NAME AS MATERIAL, FORMAT (SUM(P.QUANTITY), 0) AS QT_TOTAL, FORMAT (AVG(P.UNIT_COST), 2) AS AVG_UNIT_COST ';
                
                if($_dtMin != '' && $_dtMin != false){
                    if($_dtMax != '' && $_dtMax != false){
                        $conditions .= ' WHERE P.PURCHASE_DATE BETWEEN "' . $_dtMin . ' 00:00:00" AND "' . $_dtMax . ' 23:59:59" ';
                        
                        if($_avgUcMin != '' && $_avgUcMin != false){
                            // Tem custo unitário médio, define HAVING                                
                            if($_avgUcMax != '' && $_avgUcMax != false){
                                $having = ' HAVING AVG_UNIT_COST BETWEEN ' . $_avgUcMin . ' AND ' . $_avgUcMax . ' ';
                            } else {
                                $having = ' HAVING AVG_UNIT_COST >= ' . $_avgUcMin . ' ';
                            }
                        } else {
                            if($_avgUcMax != '' && $_avgUcMax != false){
                                $having = ' HAVING AVG_UNIT_COST <= ' . $_avgUcMax . ' ';
                            }
                        }
                    } else {
                        $conditions .= ' WHERE P.PURCHASE_DATE >= "' . $_dtMin . ' 00:00:00" ';
                        
                        if($_avgUcMin != '' && $_avgUcMin != false){
                            // Tem custo unitário médio, define HAVING                                
                            if($_avgUcMax != '' && $_avgUcMax != false){
                                $having = ' HAVING AVG_UNIT_COST BETWEEN ' . $_avgUcMin . ' AND ' . $_avgUcMax . ' ';
                            } else {
                                $having = ' HAVING AVG_UNIT_COST >= ' . $_avgUcMin . ' ';
                            }
                        } else {
                            if($_avgUcMax != '' && $_avgUcMax != false){
                                $having = ' HAVING AVG_UNIT_COST <= ' . $_avgUcMax . ' ';
                            }
                        }
                    }
                } else {
                    if($_dtMax != '' && $_dtMax != false){
                        $conditions .= ' WHERE P.PURCHASE_DATE <= "' . $_dtMax . ' 23:59:59" ';
                        
                        if($_avgUcMin != '' && $_avgUcMin != false){
                            // Tem custo unitário médio, define HAVING                                
                            if($_avgUcMax != '' && $_avgUcMax != false){
                                $having = ' HAVING AVG_UNIT_COST BETWEEN ' . $_avgUcMin . ' AND ' . $_avgUcMax . ' ';
                            } else {
                                $having = ' HAVING AVG_UNIT_COST >= ' . $_avgUcMin . ' ';
                            }
                        } else {
                            if($_avgUcMax != '' && $_avgUcMax != false){
                                $having = ' HAVING AVG_UNIT_COST <= ' . $_avgUcMax . ' ';
                            }
                        }
                    } else {
                        if($_avgUcMin != '' && $_avgUcMin != false){
                            // Tem custo unitário médio, define HAVING                                
                            if($_avgUcMax != '' && $_avgUcMax != false){
                                $having = ' HAVING AVG_UNIT_COST BETWEEN ' . $_avgUcMin . ' AND ' . $_avgUcMax . ' ';
                            } else {
                                $having = ' HAVING AVG_UNIT_COST >= ' . $_avgUcMin . ' ';
                            }
                        } else {
                            if($_avgUcMax != '' && $_avgUcMax != false){
                                $having = ' HAVING AVG_UNIT_COST <= ' . $_avgUcMax . ' ';
                            }
                        }
                    }
                }
            }
        }
        
        $selectSQL = $select . $from . $conditions . $groupBy . $having . $orderBy;
    } else {
        $selectSQL = "
            SELECT P.ID_MATERIAL, M.NAME AS MATERIAL, FORMAT (SUM(P.QUANTITY), 0) AS QT_TOTAL, FORMAT (AVG(P.UNIT_COST), 2) AS AVG_UNIT_COST 
            FROM MATERIAL_STANDARDS M 
               INNER JOIN PURCHASED P ON M.ID_MATERIAL = P.ID_MATERIAL
               INNER JOIN SUPPLIER S ON P.ID_SUPPLIER = S.ID_SUPPLIER
            GROUP BY P.ID_MATERIAL ORDER BY M.NAME ASC
        ";
    }

    include_once 'db/closeSelect.php';