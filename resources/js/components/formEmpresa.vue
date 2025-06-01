<template>
  <div class="form-container">
    <h2>Cadastrar Empresa</h2>
    <form @submit.prevent="submitForm">

      <label>Nome</label>
      <input v-model="form.nome" placeholder="Nome" required />

      <label>CEP</label>
      <input v-model="form.cep" placeholder="CEP" required />

      <label>Rua</label>
      <input v-model="form.rua" placeholder="Rua" required />

      <label>Número</label>
      <input v-model="form.numero" placeholder="Número" required />

      <label>Bairro</label>
      <input v-model="form.bairro" placeholder="Bairro" required />

      <label>Estado</label>
      <input v-model="form.estado" placeholder="Estado" required />

      <label>Whatsapp</label>
      <input v-model="form.whatsapp" placeholder="Whatsapp" required />

      <label>CPF/CNPJ</label>
      <input v-model="form.documento" placeholder="CPF/CNPJ" required />

      <label>Segmento</label>
      <select v-model="form.segmento_id" required>
        <option disabled value="">Selecione um segmento</option>
        <option v-for="segmento in segmentos" :key="segmento.id" :value="segmento.id">
          {{ segmento.nome }}
        </option>
        <option value="outro">Outro</option>
      </select>

      <input
        v-if="form.segmento_id === 'outro'"
        v-model="novoSegmento"
        placeholder="Digite o novo segmento"
        required
      />

      <button type="submit">Enviar</button>
    </form>

    <p class="mensagem" v-if="mensagem">{{ mensagem }}</p>
  </div>
</template>


<script>
import axios from 'axios';
import '../../css/formEmpresa.css';

export default {
  data() {
    return {
      form: {
        nome: '',
        cep: '',
        rua: '',
        numero: '',
        bairro: '',
        estado: '',
        whatsapp: '',
        documento: '',
        segmento_id: '',
      },
      segmentos: [],
      novoSegmento: '',
      mensagem: ''
    };
  },
  async created() {
    const response = await axios.get('http://localhost:8000/listSegmentos');
    this.segmentos = response.data.segmentos;
  },
  methods: {
    validarCampos() {
      const f = this.form;
      const camposObrigatorios = [
        { campo: f.nome, nome: "Nome" },
        { campo: f.cep, nome: "CEP" },
        { campo: f.rua, nome: "Rua" },
        { campo: f.numero, nome: "Número" },
        { campo: f.bairro, nome: "Bairro" },
        { campo: f.estado, nome: "Estado" },
        { campo: f.whatsapp, nome: "Whatsapp" },
        { campo: f.documento, nome: "Documento (CPF/CNPJ)" },
        { campo: f.segmento_id, nome: "Segmento" },
      ];

      for (let item of camposObrigatorios) {
        if (!item.campo || item.campo.toString().trim() === '') {
          this.mensagem = `O campo "${item.nome}" é obrigatório.`;
          return false;
        }
      }

      if (f.segmento_id === 'outro' && (!this.novoSegmento || this.novoSegmento.trim() === '')) {
        this.mensagem = 'Informe o nome do novo segmento.';
        return false;
      }

      if (!this.validarDocumento(f.documento)) {
        alert('Documento inválido. Use um CPF (11 dígitos) ou CNPJ (14 dígitos).');
        this.mensagem = 'Documento inválido. Use um CPF (11 dígitos) ou CNPJ (14 dígitos).'
        return false;
      }

      return true;
    },
    validarDocumento(doc) {
      const cleanDoc = doc.replace(/\D/g, '');
      return cleanDoc.length === 11 || cleanDoc.length === 14;
    },
    async submitForm() {
      if (!this.validarCampos()) return;

      try {
        const payload = { ...this.form };

        if (this.form.segmento_id === 'outro') {
          payload.novo_segmento = this.novoSegmento;
        }

        const response = await axios.post('http://localhost:8000/criarEmpresa', payload);
        this.mensagem = 'Empresa cadastrada com sucesso!';

        this.form = {
          nome: '',
          cep: '',
          rua: '',
          numero: '',
          bairro: '',
          estado: '',
          whatsapp: '',
          documento: '',
          segmento_id: '',
        };
        this.novoSegmento = '';
      } catch (error) {
        console.error(error);
        this.mensagem = 'Erro ao cadastrar empresa. Confira se as informaçõe estão corretas.';
      }
    }
  }
};
</script>
