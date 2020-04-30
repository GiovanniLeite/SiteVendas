<!doctype html>
<html>
    <link href="../../bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="../../_scripts/js/jquery.js"></script>
    
    <!-- MODAL -->
    <section id="awesome-modal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content rounded-0">
                <div class="modal-header border-0 rounded-0">
                    <h5 class="modal-title">Tem certeza de que quer excluir este produto?</h5>
                    <button type="button" class="close cp" data-dismiss="modal">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body pt-0">
                    <div class="col mt-sm-4">
                        <button id="dois" type="button" data-dismiss="modal" class="btn btn-default">Não</button>
                    </div>
                    <div class="col mt-2 mt-sm-4">
                        <button id="confirm-btn" type="button" data-dismiss="modal" class="btn btn-default">Sim</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CONTAINER -->
    <button type="button" data-toggle="modal" data-target="#awesome-modal" class="btn btn-default">Abrir Modal</button>

    <script src="../../bootstrap/js/bootstrap.bundle.min.js"></script>
    
    <script>
        let btn = document.getElementById('confirm-btn')

        btn.addEventListener('click', function(evt) {
        alert('Clicou no SIM')
        }, false)
        
        let btn2 = document.getElementById('dois')

        btn2.addEventListener('click', function(evt) {
        alert('Clicou no NÃO')
        }, false)

    </script>
</html>
