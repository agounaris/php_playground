import scala.io.Source
import scala.collection.mutable.HashMap
import scala.collection.mutable.MutableList
import scala.concurrent.duration._


object Correct {

	def main(args: Array[String]) {
		println(time (readLines(args)))	
	}

	def readLines(p: Array[String]) = {

		val arglist = p.toList

		var wordList: List[String] = List()

		for((line, count) <- Source.fromFile("dictionary.txt").getLines().zipWithIndex) { 	
			wordList ::= line.trim
		}

		arglist.foreach( e => {
				var l: Int = e.length
				var startLetter: Char = e.head
				var givenWord = e.toList
				
				var strippedWordList: List[String] = List()

				wordList.foreach( w => {
					if (w.head == e.head) {
						strippedWordList ::= w
					}
					})

				println("Testing "+e)

				strippedWordList.foreach( word => {
					var index: Int = 0

					var testWord = word.toList

					for (i <- e.indices) {

						if (givenWord(i) == testWord(i) && givenWord.length == testWord.length) {
							index = index+1;
						}

					}

					if (index>=(l-1)) {
						println(testWord mkString (""))
					}
					})

			}
		)
  			
	}

	def time(f: => Unit)={
		val s = System.currentTimeMillis
		f
		(System.currentTimeMillis - s).toFloat / 1000
	}
	
}