<div class="row">

            <div class="col">

                <form action="destino.php" target="popup" onsubmit="window.open('', 'popup', 'width = 1000, height = 600')" method="post">
                    <div class="form-row mt-3">
                        <div class="form-group col-md-12">
                            <h4>Búsqueda Asistencia</h4>
                            <hr>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <h3>Busqueda por Legajo</h3><br />
                            <input type="number" class="form-control col-md-8" id="campo_legajo" name="num_legajo" placeholder="Nº de legajo">
                        </div>

                        <div class="form-group col-md-3">
                            <h3>Filtrar</h3><br />

                            <div class="form-check">
                                <input class="form-check-input" type="radio" id="check_asistencias" name="check_asistencia" value="presentes" checked />
                                <label class="form-check-label" for="check_asistencias">Asistencias</label><br />
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" id="check_inasistencias" name="check_asistencia" value="ausentes" />
                                <label class="form-check-label" for="check_inasistencias">Inasistencias</label><br />
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" id="check_tardes" name="check_asistencia" value="llegadas_tardes">
                                <label class="form-check-label" for="check_tardes">Llegadas Tardes</label><br />
                            </div>
                        </div>
                    

                        <div class="form-group col-md-5 align-items-center">
                            <div class="form-group col-md-12">
                                <h3>Busqueda por fecha</h3>
                            </div>

                            <div class="form-group col-md-12">
                                <label for="fecha_desde">Desde
                                <input type="date" class="form-control col-md-12" name="fecha_desde" id="fecha_desde" /></label>

                                <label for="fecha_hasta">Hasta
                                <input type="date" class="form-control col-md-12" name="fecha_hasta" id="fecha_hasta" /></label>
                            </div>
                        </div>
                        <hr>
                     
                    </div>
                    <div class="form-row mt-10">
                        <div class="col-md-12">
                            <hr>
                        </div>
                        <div class="col-md-4"></div>
                        <div class="col-md-4">
                            <button type="submit" name="buscar" class="btn btn-success btn-block">Buscar</button>
                        </div>
                        <div class="col-md-4"></div>
                    </div>
                </form>
            </div>
        </div>
        
