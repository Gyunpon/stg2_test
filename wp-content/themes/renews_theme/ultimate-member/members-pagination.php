<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>


<script type="text/template" id="tmpl-um-members-pagination">
	<# if ( data.pagination.pages_to_show.length > 0 ) { #>
		<div class="um-members-pagi">
			<span class="pagi pagi-arrow <# if ( data.pagination.current_page == 1 ) { #>disabled<# } #>" data-page="first"><i class="um-faicon-angle-double-left"></i></span>
			<span class="pagi pagi-arrow <# if ( data.pagination.current_page == 1 ) { #>disabled<# } #>" data-page="prev"><i class="um-faicon-angle-left"></i></span>

			<# _.each( data.pagination.pages_to_show, function( page, key, list ) { #>
				<span class="pagi <# if ( page == data.pagination.current_page ) { #>current<# } #>" data-page="{{{page}}}">{{{page}}}</span>
			<# }); #>

			<span class="pagi pagi-arrow <# if ( data.pagination.current_page == data.pagination.total_pages ) { #>disabled<# } #>" data-page="next"><i class="um-faicon-angle-right"></i></span>
			<span class="pagi pagi-arrow <# if ( data.pagination.current_page == data.pagination.total_pages ) { #>disabled<# } #>" data-page="last"><i class="um-faicon-angle-double-right"></i></span>
		</div>
	<# } #>
</script>