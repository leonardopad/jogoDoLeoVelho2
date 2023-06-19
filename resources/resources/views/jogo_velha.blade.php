<div>
    <p>STATUS: <b id="status">EM ANDAMENTO</b></p>
    <p>QUEM ESTA JOGANDO: <b id="jogador_atual">x</b></p>
</div>

<form id="jogo-velha">
<div style="display: flex;">
<input type="text" id="pos1" name="pos1" onclick="marcarCampo(this)" value="" readonly><br><br>
<label for="fname">|</label>
<input type="text" id="pos2" name="pos2" onclick="marcarCampo(this)" value="" readonly><br><br>
<label for="fname">|</label>
<input type="text" id="pos3" name="pos3" onclick="marcarCampo(this)" value="" readonly><br><br>
<label for="fname">|</label>
</div>
<div style="display: flex;">
<input type="text" id="pos4" name="pos4" onclick="marcarCampo(this)" value="" readonly><br><br>
<label for="fname">|</label>
<input type="text" id="pos5" name="pos5" onclick="marcarCampo(this)" value="" readonly><br><br>
<label for="fname">|</label>
<input type="text" id="pos6" name="pos6" onclick="marcarCampo(this)" value="" readonly><br><br>
<label for="fname">|</label>
</div>
<div style="display: flex;">
<input type="text" id="pos7" name="pos7" onclick="marcarCampo(this)" value="" readonly><br><br>
<label for="fname">|</label>
<input type="text" id="pos8" name="pos8" onclick="marcarCampo(this)" value="" readonly><br><br>
<label for="fname">|</label>
<input type="text" id="pos9" name="pos9" onclick="marcarCampo(this)" value="" readonly><br><br>
<label for="fname">|</label>
</div>
</form>
<button onclick="recomecar()">RECOMEÇAR</button>


<script>

var jogadorAtual = 'x';

window.addEventListener("load", function(event) {
    limparCampos();
});

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
}

function marcarCampo(campo) {
    if(campo.value) return;

    campo.value = jogadorAtual;
    jogadorAtual = jogadorAtual == 'x' ? 'o' : 'x'; 
    document.getElementById('jogador_atual').innerHTML = jogadorAtual;

    checarJogo();
}

async function checarJogo() {
    var form = new FormData(document.getElementById('jogo-velha'));
    console.log(form)
    let response = await fetch('http://127.0.0.1:8000/api/jogo-da-velha', {
        method: "POST",
        body: form
    })
    let data = await response.json();
    document.getElementById('status').innerHTML = data.STATUS
}

function recomecar() {
    limparCampos()
}
</script>