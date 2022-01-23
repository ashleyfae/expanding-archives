/* global expandingArchives */

/**
 * Sets up on DOM load events.
 */
document.addEventListener( 'DOMContentLoaded', () => {
    const years = document.querySelectorAll( '.expanding-archives-title a' );
    if ( years ) {
        years.forEach( year => {
            year.addEventListener( 'click', toggleYear );
        } )
    }

    const months = document.querySelectorAll( 'a.expanding-archives-clickable-month' );
    if ( months ) {
        months.forEach( month => {
            month.addEventListener( 'click', maybeLoadMonths );
        } )
    }
} );

/**
 * Changes the visibility of a year.
 * @since 2.0
 * @param e
 */
function toggleYear( e ) {
    e.preventDefault();

    const yearLink = this;
    const yearWrapId = yearLink.getAttribute( 'data-wrapper' );
    const yearWrap = yearWrapId ? document.getElementById( yearWrapId ) : null;

    if ( ! yearWrap ) {
        console.log( 'No year wrap found.', yearLink );
        return;
    }

    if ( yearWrap.classList.contains( 'expanding-archives-expanded' ) ) {
        yearWrap.classList.remove( 'expanding-archives-expanded' );
    } else {
        yearWrap.classList.add( 'expanding-archives-expanded' );
    }
}

/**
 * Loads the posts for the selected month.
 * If the data has already been loaded, then we just toggle the visibility of the contents.
 *
 * @since 2.0
 *
 * @param e
 */
function maybeLoadMonths( e ) {
    e.preventDefault();

    const monthLink = this;
    const resultsWrapper = monthLink.parentElement.querySelector( '.expanding-archive-month-results' );

    // Check if we've done the ajax call already.
    if ( monthLink.getAttribute( 'data-rendered' ) === '1' ) {
        toggleMonth( monthLink );
    } else {
        const spinner = monthLink.querySelector( '.expanding-archives-spinner' );
        if ( spinner ) {
            spinner.classList.add( 'expanding-archives-spinner--active' );
        }

        const url = new URL( expandingArchives.restBase );
        url.searchParams.append( 'after', monthLink.getAttribute( 'data-after' ) );
        url.searchParams.append( 'before', monthLink.getAttribute( 'data-before' ) );
        url.searchParams.append( '_fields', 'title,link' );

        fetch( url.href )
            .then( response => response.json() )
            .then( response => {
                console.log( 'Response', response );
                resultsWrapper.innerHTML = response.map( formatPost ).join( "\n" );
                monthLink.setAttribute( 'data-rendered', '1' );
                toggleMonth( monthLink );
            } )
            .catch( error => {
                console.log( 'Expanding Archives Error', error );
            } )
            .finally( () => {
                if ( spinner ) {
                    spinner.classList.remove( 'expanding-archives-spinner--active' );
                }
            } )
    }
}

/**
 * Expands or collapses a month, based on its current visibility.
 *
 * @since 2.0
 *
 * @param {HTMLElement} monthLink
 */
function toggleMonth( monthLink ) {
    const childExpander = monthLink.querySelector( '.expand-collapse' );
    const resultsWrapper = monthLink.parentElement.querySelector( '.expanding-archive-month-results' );

    if ( childExpander.classList.contains( 'archive-expanded' ) ) {
        childExpander.classList.remove( 'archive-expanded' );
        childExpander.innerHTML = '+';
        resultsWrapper.style.display = 'none';
    } else {
        childExpander.classList.add( 'archive-expanded' );
        childExpander.innerHTML = '&ndash;';
        resultsWrapper.style.display = 'block';
    }
}

/**
 * Formats the HTML for a single post.
 *
 * @since 2.0
 *
 * @param {object} post
 * @returns {string}
 */
function formatPost( post ) {
    return `<li>
    <a href="${post.link}">${post.title.rendered}</a>
</li>`;
}
