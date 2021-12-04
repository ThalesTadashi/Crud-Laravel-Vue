<template>
    <div>
        <h1 class="text-center">Lista de Materiais</h1>
        <hr>
			<button @click="update=false; openModal();" type="button" class="btn btn-primary">
			  Adicionar Materiais
			</button>

            <div class="modal" :class="{show:modal}">
                <div class="modal-dialog">
                    <div class="modal-content">
                            <div class="modal-header">     
                                 <h5 class="modal-title">{{titleModal}}</h5>
                 <button @click="closeModal();" type="button" class="close" data-dismiss="modal"     aria-label="Close">
                                 <span aria-hidden="true">&times;</span>
                                 </button>
                            </div>
                             <div class="modal-body">
                                <div>
                                     <label for="name">Nome</label>
                                         <input v-model="material.name" type="text" class="form-control" id="name" placeholder="Nome do Material" name="">
                                </div>  
                                <div>
                                     <label for="brand">Marca</label>
                                         <input v-model="material.brand" type="text" class="form-control" id="brand" placeholder="Marca" name="">
                                </div>       
                                <div>
                                     <label for="description">Descrição</label>
                                         <input v-model="material.description" type="text" class="form-control" id="description" placeholder="Descrição" name="">
                                </div>  
                                <div>
                                     <label for="price">Valor</label>
                                         <input v-model="material.price" type="text" class="form-control" id="price" placeholder="Valor" name="">
                                </div>  
                             
                    </div>
                                <div class="modal-footer">
                                     <button @click="closeModal();" type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                    <button @click="save();" type="button" class="btn btn-success">Salvar</button>
                                </div>
                     </div>
                 </div>
            </div>
                            
		<table class="table table-striped table-hover">
		  <thead class="thead-dark">
		    <tr>
		      <th scope="col">Id</th>
		      <th scope="col">Nome</th>
		      <th scope="col">Marca</th>
		      <th scope="col">Descrição</th>
		      <th scope="col">Valor</th>
		      <th scope="col">Editado</th>
		      <th scope="col" colspan="2" class="text-center">Ação</th>
		    </tr>
		  </thead>
		  <tbody>
		    <tr v-for="material in material" :key="material.id">
		      <th scope="row">{{ material.id }}</th>
		      <td>{{ material.name }}</td>
		      <td>{{ material.brand }}</td>
		      <td>{{ material.description }}</td>
		      <td>{{ material.price }}</td>
		      <td>{{ material.updated_at }}</td>
		        <td>
		      	    <button @click="update=true; openModal(material.id);" class="btn btn-warning">Editar</button>
		        </td>
		        <td>
		      	    <button @click="eliminar(material.id)" class="btn btn-danger">Excluir</button>
		        </td>
		    </tr>
		  </tbody>
		</table>

    </div>
</template>

<script>
 	export default {
		data () {
			return {
				material: {
					name:'',
					description:'',
					brand:'',
					price:''
				},
				id:0,
				update:true,
				modal:0,
				titleModal:'',
				material:[],
			}
		},
		methods: {
			async list() {
				const res = await axios.get('material');
				this.material = res.data;
			},
			async eliminar(id) {
				const res = await axios.delete('/material/' +id);
				this.list();
			},
			async save() {
				if (this.update) {
					const res = await axios.post('/material/' + this.id, this.material);
				}else{
					const res = await axios.post('/material', this.material);
				}
				this.closeModal();
				this.list();
			},
			openModal(data={}) {
				this.modal=1;
				if (this.update) {

					this.id = data.id,
					this.titleModal="Modificar Material";

					this.materials.name = data.name;
					this.materials.description = data.description;
					this.materials.brand = data.brand;
					this.materials.price = data.price;
				}else
				{
					this.id=0,
					this.titleModal="Criar Material";

					this.materials.name = 'asd';
					this.materials.description = 'asd';
					this.materials.brand = 'ad';
					this.materials.price = '';
					
				}
			},
			closeModal() {
				this.modal=0;
			},
		},
		created() {
			this.list();
		},
	}
</script>

<style>
    .show {
        display: list-item;
        opacity: 1;
        background: rgba(44, 38, 75, 0.849);
    }
</style>