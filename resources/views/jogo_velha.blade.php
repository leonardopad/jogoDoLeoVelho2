<style>
body {
    background-color: #2a2a72;
    color: white;
    background-image: linear-gradient(315deg, #2a2a72 0%, #009ffd 74%);
}
button {
    margin-top: 10px;
    background-color: #cecece; /* Green */
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
}

input {
    text-align: center;
}
</style>

<center>
<div>
    <p>STATUS: <b id="status">EM ANDAMENTO</b></p>
    <p>QUEM ESTA JOGANDO: <b id="jogador_atual"></b></p>
    <hr>
    <p>Jogador 1: <b id="nome_jogador1"></b></p>
    <p>Jogador 2: <b id="nome_jogador2"></b></p>
</div>

<form id="jogo-velha" style="margin: 0 auto;">
<div style="display: flex; justify-content: center;">
<input type="text" id="pos1" name="pos1" onclick="marcarCampo(this)" value="" readonly><br><br>
<label for="fname">|</label>
<input type="text" id="pos2" name="pos2" onclick="marcarCampo(this)" value="" readonly><br><br>
<label for="fname">|</label>
<input type="text" id="pos3" name="pos3" onclick="marcarCampo(this)" value="" readonly><br><br>
<label for="fname">|</label>
</div>
<div style="display: flex; justify-content: center;">
<input type="text" id="pos4" name="pos4" onclick="marcarCampo(this)" value="" readonly><br><br>
<label for="fname">|</label>
<input type="text" id="pos5" name="pos5" onclick="marcarCampo(this)" value="" readonly><br><br>
<label for="fname">|</label>
<input type="text" id="pos6" name="pos6" onclick="marcarCampo(this)" value="" readonly><br><br>
<label for="fname">|</label>
</div>
<div style="display: flex; justify-content: center;">
<input type="text" id="pos7" name="pos7" onclick="marcarCampo(this)" value="" readonly><br><br>
<label for="fname">|</label>
<input type="text" id="pos8" name="pos8" onclick="marcarCampo(this)" value="" readonly><br><br>
<label for="fname">|</label>
<input type="text" id="pos9" name="pos9" onclick="marcarCampo(this)" value="" readonly><br><br>
<label for="fname">|</label>
</div>
</form>
<button onclick="recomecar()">RECOMEÇAR</button>
</center>

<script>

var jogadorAtual = 'x';

var jogador = {
    x: '',
    o: ''
}

window.addEventListener("load", function(event) {
    limparCampos();
    autenticacaoUsuarios()
});

async function autenticacaoUsuarios() {
    let player1Logged = true
    while(player1Logged) {
        let usuario_login = prompt('Jogador 1: Digite seu login logo abaixo')
        let usuario_senha = prompt('Jogador 1: Digite sua senha logo abaixo')

        var form = new FormData();
        form.append('nickname', usuario_login)
        form.append('password', usuario_senha)

        try {
            let response = await fetch('http://127.0.0.1:8000/api/v1/jogo-da-velha-autenticacao', {
                method: "POST",
                body: form
            })
            
            response = await response.json()

            if(response.id) {
                player1Logged = false
                document.getElementById('nome_jogador1').innerHTML = response.name
                jogador['x'] = response.name
            }
        } catch (err) {
            continue;
        }
    }

    let player2Logged = true
    while(player2Logged) {
        let usuario_login = prompt('Jogador 2: Digite seu login logo abaixo')
        let usuario_senha = prompt('Jogador 2: Digite sua senha logo abaixo')

        var form = new FormData();
        form.append('nickname', usuario_login)
        form.append('password', usuario_senha)

        try {
            let response = await fetch('http://127.0.0.1:8000/api/v1/jogo-da-velha-autenticacao', {
                method: "POST",
                body: form
            })
            
            response = await response.json()

            if(response.id) {
                document.getElementById('nome_jogador2').innerHTML = response.name
                player2Logged = false
                jogador['o'] = response.name
            }
        } catch (err) {
            continue;
        }

    }

    document.getElementById('jogador_atual').innerHTML = jogador['x'];
}

function limparCampos() {
    document.getElementById('pos1').value = '';
    document.getElementById('pos2').value = '';
    document.getElementById('pos3').value = '';
    document.getElementById('pos4').value = '';
    document.getElementById('pos5').value = '';
    document.getElementById('pos6').value = '';
    document.getElementById('pos7').value = '';
    document.getElementById('pos8').value = '';
    document.getElementById('pos9').value = '';
    document.getElementById('jogador_atual').innerHTML = '';
}

function marcarCampo(campo) {
    if(document.getElementById('status').innerHTML != 'EM ANDAMENTO') return;
    if(campo.value) return;

    campo.value = jogadorAtual;
    jogadorAtual = jogadorAtual == 'x' ? 'o' : 'x'; 
    document.getElementById('jogador_atual').innerHTML = jogador[jogadorAtual];

    checarJogo();
}

async function checarJogo() {

    var form = new FormData(document.getElementById('jogo-velha'));
    let response = await fetch('http://127.0.0.1:8000/api/v1/jogo-da-velha', {
        method: "POST",
        body: form
    })
    let data = await response.json();
    document.getElementById('status').innerHTML = data.STATUS
}

function recomecar() {
    limparCampos()
    document.getElementById('status').innerHTML  = 'EM ANDAMENTO'
}

</script>