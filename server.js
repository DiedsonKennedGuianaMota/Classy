const express = require('express');
const path = require('path');
const app = express();
const PORT = process.env.PORT || 3000;

// Middleware para servir arquivos estáticos da pasta "public"
app.use(bodyParser.urlencoded({ extended: true }));
app.use(bodyParser.json());

app.use(express.static(path.join(__dirname, 'public')));

const db = mysql.createConnection({
  host: 'localhost',
  user: 'root',
  password: '',
  database: 'cadastro'
});
db.connect((err) => {
  if (err) {
    console.error('Erro na conexão:', err);
    return;
  }
  console.log('Conectado ao MySQL!');
});
//salvando dados no server
const bcrypt = require('bcrypt');
const saltRounds = 10;

app.post('/salvar', upload.single('imagem'), (req, res) => {
  const { nome, email, matricula, telefone, senha } = req.body;
  const imagem = req.file ? req.file.filename : null;

  bcrypt.hash(senha, saltRounds, (err, hash) => {
    if (err) {
      console.error('Erro ao criptografar senha:', err);
      return res.status(500).send('Erro ao processar senha');
    }

    const sql = 'INSERT INTO usuarios (nome, email, matricula, telefone, senha, imagem) VALUES (?, ?, ?, ?, ?, ?)';
    const valores = [nome, email, matricula, telefone, hash, imagem];

    db.query(sql, valores, (err, result) => {
      if (err) {
        console.error('Erro ao salvar no banco:', err);
        res.status(500).send('Erro ao salvar dados');
      } else {
        res.send('Usuário salvo com sucesso!');
      }
    });
  });
});
// Rota principal (index)
app.get('/', (req, res) => {
  res.sendFile(path.join(__dirname, 'public', 'index.html'));
});

// ✅ Rota para login do aluno
app.get('/login-aluno', (req, res) => {
  res.sendFile(path.join(__dirname, 'public', 'login-aluno.html'));
});

// ✅ Rota para Perfil
app.get('/perfil', (req, res) => {
  res.sendFile(path.join(__dirname, 'public', 'perfil.html'));
});

// ✅ Rota para Home
app.get('/home', (req, res) => {
  res.sendFile(path.join(__dirname, 'public', 'home.html'));
});

// ✅ Rota para Fórum
app.get('/forum', (req, res) => {
  res.sendFile(path.join(__dirname, 'public', 'forum.html'));
});

// ✅ Rota para Aulas
app.get('/aulas', (req, res) => {
  res.sendFile(path.join(__dirname, 'public', 'aulas.html'));
});

// ✅ Rota para exercicios
app.get('/exerci', (req, res) => {
  res.sendFile(path.join(__dirname, 'public', 'conteudos.html'));
});

// ✅ Rota para ranking
app.get('/ranking', (req, res) => {
  res.sendFile(path.join(__dirname, 'public', 'ranking.html'));
});

// ✅ Rota para certificados
app.get('/certificados', (req, res) => {
  res.sendFile(path.join(__dirname, 'public', 'certificados.html'));
});

// Iniciar servidor
app.listen(PORT, () => {
  console.log(`✅ Servidor rodando em http://localhost:${PORT}`);
  console.log(`📁 Pasta pública: ${path.join(__dirname, 'public')}`);
});
