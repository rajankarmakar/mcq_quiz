;(function($) {
    const MCQ_System = {
        init: function() {
            let self = this;
            $( '#mcq_form' ).on( 'submit', function(e) {
                e.preventDefault();

                let results = [];
                let allAnswers = $("input[type='radio']:checked");
                $( allAnswers ).each( function( i ) {
                    results.push( $(allAnswers[i]).val() );
                } );

                const correctAns = [];
                let ansList = $("input[type='hidden']");
                $( ansList ).each( function( i ) {
                    correctAns.push( $(ansList[i]).val() );
                } );

                let finalResult = self.findResult( results, correctAns );

                $( '#result_container' ).html(`
                    <h3> Congratulation! </h3>
                    <p>You score is: ${finalResult.rightAns} out of ${results.length}</p>
                    <p>Correct answers: ${finalResult.rightAns} </p>
                    <p>Wrong answers: ${finalResult.wrongAns} </p>
                `);
            } );
        },
        findResult: function( result, correctAns ) {
            let rightAns = 0;
            let wrongAns = 0;
            for (let i = 0; i < result.length; i++) {
                if ( result[i] == correctAns[i] ) {
                    rightAns++;
                } else {
                    wrongAns++;
                }
            }

            return { rightAns, wrongAns };
        }
    };

    $(document).ready( function() {
        MCQ_System.init();
    });
})(jQuery);