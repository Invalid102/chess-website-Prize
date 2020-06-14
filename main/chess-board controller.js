$(document).ready(function() {
  var board = null
  var game = new Chess()

  var whiteSquare = '#f0d9b5'
  var blackSquare = '#b58863'
  var audio_move_piece = new Audio('resources/sound/move_piece.wav')
  var audio_take_piece = new Audio('resources/sound/take_piece.wav')
  var $status = $('#status')

  function updateStatus () {
    var status = ''
  
    var moveColor = 'White'
    if (game.turn() === 'b') {
      moveColor = 'Black'
    }
  
    if (game.in_checkmate()) {
      status = 'Game over, ' + moveColor + ' is in checkmate.'
    }
  
    else if (game.in_draw()) {
      status = 'Game over, drawn position'
    }
  
    else {
      status = moveColor + ' to move'
  
      if (game.in_check()) {
        status += ', ' + moveColor + ' is in check'
      }
    }
    $status.html(status)
  }

  function removeHighlightedSquares () {
    $('#chess-board .square-55d63').css('background', '') // all squares have class 'square-55d63'
  }

  function highlightSquare (square) {
    var $square = $('#chess-board .square-' + square) // e.g. 'square-a8'

    var background = whiteSquare
    if ($square.hasClass('black-3c85d')) {
        background = blackSquare
      }
    
    if (game.get(square) != null){ //highlighting a piece
      $square.css('background', "radial-gradient("+background+" 80%, red 81%)")
    } 
    else{
      $square.css('background', "radial-gradient(rgba(20,85,30,0.5) 25%, "+background+" 26%)")
    }
    
  }

  function onDragStart (source, piece) {

    if (game.game_over()) return false

    // check which turn
    if ((game.turn() === 'w' && piece.search(/^b/) !== -1) ||
        (game.turn() === 'b' && piece.search(/^w/) !== -1)) {
      return false
    }
  }

  function onDrop (source, target) {
    removeHighlightedSquares()

    var piece_on_target = false;
    if (game.get(target) != null){ // piece on target square
      piece_on_target = true
    }

    // see if the move is legal
    var move = game.move({
      from: source,
      to: target,
      promotion: 'q' // always promote to queen
    })

    // illegal move
    if (move === null) return 'snapback'

    updateStatus()
    if (piece_on_target){ // piece on target square
      audio_take_piece.play();
    }
    else {
      audio_move_piece.play();
    }
  }

  function onMouseoverSquare (square, piece) {
    // get list of possible moves for this square
    var moves = game.moves({
      square: square,
      verbose: true
    })

    if (moves.length === 0) return

    // highlight the possible squares for this piece
    for (var i = 0; i < moves.length; i++) {
      highlightSquare(moves[i].to)
    }
  }

  function onMouseoutSquare (square, piece) {
    removeHighlightedSquares()
  }

  function onSnapEnd () {
    board.position(game.fen())
  }

  var config = {
    draggable: true,
    position: 'start',
    onDragStart: onDragStart,
    onDrop: onDrop,
    onMouseoutSquare: onMouseoutSquare,
    onMouseoverSquare: onMouseoverSquare,
    onSnapEnd: onSnapEnd
  }
  board = Chessboard('chess-board', config)
  updateStatus()
});