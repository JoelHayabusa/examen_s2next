<!-- Modal -->
<div class="modal fade" id="modalAddMenu" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Nuevo Menu</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="closeAddMenuModal();">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formAddMenu">
        <input type="hidden" id="idMenu" name="idMenu" value=-1>
            <div class="form-row">
                <div class="form-group">
                <label for="formAddMenuNombre">Nombre del menu</label>
                <input type="text" class="form-control" id="formAddMenuNombre" placeholder="Nombre" required="">
                </div>
            </div>
            <div class="form-group">
                <label for="formAddMenuDescripcion">Descripcion</label>
                <textarea type="text" class="form-control" id="formAddMenuDescripcion" placeholder="Descripcion" required=""></textarea>
            </div>
            <div class="form-row">

                <div class="form-group">
                <label for="cbbNombrePadre">Padre</label>
                <select id="cbbNombrePadre" class="form-control">
                    <option selected value="0">Seleccionar</option>
                </select>
                </div>
            </div>
            <div class="tile-footer">
                <button type="submit" class="btn btn-primary" id="btnFormAction">Guardar</button>
                <a class="btn btn-secondary" onclick="closeAddMenuModal();">Cancelar</a>
            </div>
            </form>
      </div>
    </div>
  </div>
</div>