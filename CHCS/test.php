<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8">
	</script>
	<script type="text/javascript" language="javascript" src="js/plugins/jquery/jquery.min.js">
	</script>
	<script type="text/javascript" language="javascript" src="js/plugins/datatables/jquery.dataTables.min.js">
	</script>
	
	<script type="text/javascript" class="init">
	

$(document).ready(function() {
	$('#example').DataTable( {
		"footerCallback": function ( row, data, start, end, display ) {
			var api = this.api(), data;

			// Remove the formatting to get integer data for summation
			var intVal = function ( i ) {
				return typeof i === 'string' ?
					i.replace(/[\$,]/g, '')*1 :
					typeof i === 'number' ?
						i : 0;
			};

			// Total over all pages
			total = api
				.column( 4 )
				.data()
				.reduce( function (a, b) {
					return intVal(a) + intVal(b);
				}, 0 );

			// Total over this page
			pageTotal = api
				.column( 4, { page: 'current'} )
				.data()
				.reduce( function (a, b) {
					return intVal(a) + intVal(b);
				}, 0 );

			// Update footer
			$( api.column( 4 ).footer() ).html(
				'$'+pageTotal +' ( $'+ total +' total)'
			);
		}
	} );
} );


	</script>
</head>
<body class="wide comments example">
	<a name="top" id="top"></a>
	<div class="fw-container">
		
		
		<div class="fw-body">
			<div class="content">
				<h1 class="page_title">Footer callback</h1>
				<div class="info">
					<p>Through the use of the header and footer callback manipulation functions provided by DataTables (<a href=
					"//datatables.net/reference/option/headerCallback"><code class="option" title="DataTables initialisation option">headerCallback</code></a> and <a href=
					"//datatables.net/reference/option/footerCallback"><code class="option" title="DataTables initialisation option">footerCallback</code></a>), it is possible to
					perform some powerful and useful data manipulation functions, such as summarising data in the table.</p>
					<p>The example below shows a footer callback being used to total the data for a column (both the visible and the hidden data) using the <a href=
					"//datatables.net/reference/api/column().data()"><code class="api" title="DataTables API method">column().data()</code></a> API method and <a href=
					"//datatables.net/reference/api/column().footer()"><code class="api" title="DataTables API method">column().footer()</code></a> for writing the value into the
					footer.</p>
				</div>
				<table id="example" class="display" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th>First name</th>
							<th>Last name</th>
							<th>Position</th>
							<th>Office</th>
							<th>Salary</th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<th colspan="4" style="text-align:right">Total:</th>
							<th></th>
						</tr>
					</tfoot>
					<tbody>
						<tr>
							<td>Tiger</td>
							<td>Nixon</td>
							<td>System Architect</td>
							<td>Edinburgh</td>
							<td>$320,800</td>
						</tr>
						<tr>
							<td>Garrett</td>
							<td>Winters</td>
							<td>Accountant</td>
							<td>Tokyo</td>
							<td>$170,750</td>
						</tr>
						<tr>
							<td>Ashton</td>
							<td>Cox</td>
							<td>Junior Technical Author</td>
							<td>San Francisco</td>
							<td>$86,000</td>
						</tr>
						<tr>
							<td>Cedric</td>
							<td>Kelly</td>
							<td>Senior Javascript Developer</td>
							<td>Edinburgh</td>
							<td>$433,060</td>
						</tr>
						<tr>
							<td>Airi</td>
							<td>Satou</td>
							<td>Accountant</td>
							<td>Tokyo</td>
							<td>$162,700</td>
						</tr>
						<tr>
							<td>Brielle</td>
							<td>Williamson</td>
							<td>Integration Specialist</td>
							<td>New York</td>
							<td>$372,000</td>
						</tr>
						<tr>
							<td>Herrod</td>
							<td>Chandler</td>
							<td>Sales Assistant</td>
							<td>San Francisco</td>
							<td>$137,500</td>
						</tr>
						<tr>
							<td>Rhona</td>
							<td>Davidson</td>
							<td>Integration Specialist</td>
							<td>Tokyo</td>
							<td>$327,900</td>
						</tr>
						<tr>
							<td>Colleen</td>
							<td>Hurst</td>
							<td>Javascript Developer</td>
							<td>San Francisco</td>
							<td>$205,500</td>
						</tr>
						<tr>
							<td>Sonya</td>
							<td>Frost</td>
							<td>Software Engineer</td>
							<td>Edinburgh</td>
							<td>$103,600</td>
						</tr>
						<tr>
							<td>Jena</td>
							<td>Gaines</td>
							<td>Office Manager</td>
							<td>London</td>
							<td>$90,560</td>
						</tr>
						<tr>
							<td>Quinn</td>
							<td>Flynn</td>
							<td>Support Lead</td>
							<td>Edinburgh</td>
							<td>$342,000</td>
						</tr>
						<tr>
							<td>Charde</td>
							<td>Marshall</td>
							<td>Regional Director</td>
							<td>San Francisco</td>
							<td>$470,600</td>
						</tr>
						<tr>
							<td>Haley</td>
							<td>Kennedy</td>
							<td>Senior Marketing Designer</td>
							<td>London</td>
							<td>$313,500</td>
						</tr>
						<tr>
							<td>Tatyana</td>
							<td>Fitzpatrick</td>
							<td>Regional Director</td>
							<td>London</td>
							<td>$385,750</td>
						</tr>
						<tr>
							<td>Michael</td>
							<td>Silva</td>
							<td>Marketing Designer</td>
							<td>London</td>
							<td>$198,500</td>
						</tr>
						<tr>
							<td>Paul</td>
							<td>Byrd</td>
							<td>Chief Financial Officer (CFO)</td>
							<td>New York</td>
							<td>$725,000</td>
						</tr>
						<tr>
							<td>Gloria</td>
							<td>Little</td>
							<td>Systems Administrator</td>
							<td>New York</td>
							<td>$237,500</td>
						</tr>
						<tr>
							<td>Bradley</td>
							<td>Greer</td>
							<td>Software Engineer</td>
							<td>London</td>
							<td>$132,000</td>
						</tr>
						<tr>
							<td>Dai</td>
							<td>Rios</td>
							<td>Personnel Lead</td>
							<td>Edinburgh</td>
							<td>$217,500</td>
						</tr>
						<tr>
							<td>Jenette</td>
							<td>Caldwell</td>
							<td>Development Lead</td>
							<td>New York</td>
							<td>$345,000</td>
						</tr>
						<tr>
							<td>Yuri</td>
							<td>Berry</td>
							<td>Chief Marketing Officer (CMO)</td>
							<td>New York</td>
							<td>$675,000</td>
						</tr>
						<tr>
							<td>Caesar</td>
							<td>Vance</td>
							<td>Pre-Sales Support</td>
							<td>New York</td>
							<td>$106,450</td>
						</tr>
						<tr>
							<td>Doris</td>
							<td>Wilder</td>
							<td>Sales Assistant</td>
							<td>Sidney</td>
							<td>$85,600</td>
						</tr>
						<tr>
							<td>Angelica</td>
							<td>Ramos</td>
							<td>Chief Executive Officer (CEO)</td>
							<td>London</td>
							<td>$1,200,000</td>
						</tr>
						<tr>
							<td>Gavin</td>
							<td>Joyce</td>
							<td>Developer</td>
							<td>Edinburgh</td>
							<td>$92,575</td>
						</tr>
						<tr>
							<td>Jennifer</td>
							<td>Chang</td>
							<td>Regional Director</td>
							<td>Singapore</td>
							<td>$357,650</td>
						</tr>
						<tr>
							<td>Brenden</td>
							<td>Wagner</td>
							<td>Software Engineer</td>
							<td>San Francisco</td>
							<td>$206,850</td>
						</tr>
						<tr>
							<td>Fiona</td>
							<td>Green</td>
							<td>Chief Operating Officer (COO)</td>
							<td>San Francisco</td>
							<td>$850,000</td>
						</tr>
						<tr>
							<td>Shou</td>
							<td>Itou</td>
							<td>Regional Marketing</td>
							<td>Tokyo</td>
							<td>$163,000</td>
						</tr>
						<tr>
							<td>Michelle</td>
							<td>House</td>
							<td>Integration Specialist</td>
							<td>Sidney</td>
							<td>$95,400</td>
						</tr>
						<tr>
							<td>Suki</td>
							<td>Burks</td>
							<td>Developer</td>
							<td>London</td>
							<td>$114,500</td>
						</tr>
						<tr>
							<td>Prescott</td>
							<td>Bartlett</td>
							<td>Technical Author</td>
							<td>London</td>
							<td>$145,000</td>
						</tr>
						<tr>
							<td>Gavin</td>
							<td>Cortez</td>
							<td>Team Leader</td>
							<td>San Francisco</td>
							<td>$235,500</td>
						</tr>
						<tr>
							<td>Martena</td>
							<td>Mccray</td>
							<td>Post-Sales support</td>
							<td>Edinburgh</td>
							<td>$324,050</td>
						</tr>
						<tr>
							<td>Unity</td>
							<td>Butler</td>
							<td>Marketing Designer</td>
							<td>San Francisco</td>
							<td>$85,675</td>
						</tr>
						<tr>
							<td>Howard</td>
							<td>Hatfield</td>
							<td>Office Manager</td>
							<td>San Francisco</td>
							<td>$164,500</td>
						</tr>
						<tr>
							<td>Hope</td>
							<td>Fuentes</td>
							<td>Secretary</td>
							<td>San Francisco</td>
							<td>$109,850</td>
						</tr>
						<tr>
							<td>Vivian</td>
							<td>Harrell</td>
							<td>Financial Controller</td>
							<td>San Francisco</td>
							<td>$452,500</td>
						</tr>
						<tr>
							<td>Timothy</td>
							<td>Mooney</td>
							<td>Office Manager</td>
							<td>London</td>
							<td>$136,200</td>
						</tr>
						<tr>
							<td>Jackson</td>
							<td>Bradshaw</td>
							<td>Director</td>
							<td>New York</td>
							<td>$645,750</td>
						</tr>
						<tr>
							<td>Olivia</td>
							<td>Liang</td>
							<td>Support Engineer</td>
							<td>Singapore</td>
							<td>$234,500</td>
						</tr>
						<tr>
							<td>Bruno</td>
							<td>Nash</td>
							<td>Software Engineer</td>
							<td>London</td>
							<td>$163,500</td>
						</tr>
						<tr>
							<td>Sakura</td>
							<td>Yamamoto</td>
							<td>Support Engineer</td>
							<td>Tokyo</td>
							<td>$139,575</td>
						</tr>
						<tr>
							<td>Thor</td>
							<td>Walton</td>
							<td>Developer</td>
							<td>New York</td>
							<td>$98,540</td>
						</tr>
						<tr>
							<td>Finn</td>
							<td>Camacho</td>
							<td>Support Engineer</td>
							<td>San Francisco</td>
							<td>$87,500</td>
						</tr>
						<tr>
							<td>Serge</td>
							<td>Baldwin</td>
							<td>Data Coordinator</td>
							<td>Singapore</td>
							<td>$138,575</td>
						</tr>
						<tr>
							<td>Zenaida</td>
							<td>Frank</td>
							<td>Software Engineer</td>
							<td>New York</td>
							<td>$125,250</td>
						</tr>
						<tr>
							<td>Zorita</td>
							<td>Serrano</td>
							<td>Software Engineer</td>
							<td>San Francisco</td>
							<td>$115,000</td>
						</tr>
						<tr>
							<td>Jennifer</td>
							<td>Acosta</td>
							<td>Junior Javascript Developer</td>
							<td>Edinburgh</td>
							<td>$75,650</td>
						</tr>
						<tr>
							<td>Cara</td>
							<td>Stevens</td>
							<td>Sales Assistant</td>
							<td>New York</td>
							<td>$145,600</td>
						</tr>
						<tr>
							<td>Hermione</td>
							<td>Butler</td>
							<td>Regional Director</td>
							<td>London</td>
							<td>$356,250</td>
						</tr>
						<tr>
							<td>Lael</td>
							<td>Greer</td>
							<td>Systems Administrator</td>
							<td>London</td>
							<td>$103,500</td>
						</tr>
						<tr>
							<td>Jonas</td>
							<td>Alexander</td>
							<td>Developer</td>
							<td>San Francisco</td>
							<td>$86,500</td>
						</tr>
						<tr>
							<td>Shad</td>
							<td>Decker</td>
							<td>Regional Director</td>
							<td>Edinburgh</td>
							<td>$183,000</td>
						</tr>
						<tr>
							<td>Michael</td>
							<td>Bruce</td>
							<td>Javascript Developer</td>
							<td>Singapore</td>
							<td>$183,000</td>
						</tr>
						<tr>
							<td>Donna</td>
							<td>Snider</td>
							<td>Customer Support</td>
							<td>New York</td>
							<td>$112,000</td>
						</tr>
					</tbody>
				</table>
				<ul class="tabs">
					<li class="active">Javascript</li>
					<li>HTML</li>
					<li>CSS</li>
					<li>Ajax</li>
					<li>Server-side script</li>
					<li class="comment-count">Comments</li>
				</ul>
				<div class="tabs">
					<div class="js">
						<p>The Javascript shown below is used to initialise the table shown in this example:</p><code class="multiline language-js">$(document).ready(function() {
	$('#example').DataTable( {
		&quot;footerCallback&quot;: function ( row, data, start, end, display ) {
			var api = this.api(), data;

			// Remove the formatting to get integer data for summation
			var intVal = function ( i ) {
				return typeof i === 'string' ?
					i.replace(/[\$,]/g, '')*1 :
					typeof i === 'number' ?
						i : 0;
			};

			// Total over all pages
			total = api
				.column( 4 )
				.data()
				.reduce( function (a, b) {
					return intVal(a) + intVal(b);
				}, 0 );

			// Total over this page
			pageTotal = api
				.column( 4, { page: 'current'} )
				.data()
				.reduce( function (a, b) {
					return intVal(a) + intVal(b);
				}, 0 );

			// Update footer
			$( api.column( 4 ).footer() ).html(
				'$'+pageTotal +' ( $'+ total +' total)'
			);
		}
	} );
} );</code>
						<p>In addition to the above code, the following Javascript library files are loaded for use in this example:</p>
						<ul>
							<li>
								<a href="//code.jquery.com/jquery-1.12.0.min.js">//code.jquery.com/jquery-1.12.0.min.js</a>
							</li>
							<li>
								<a href="https://cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js">https://cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js</a>
							</li>
						</ul>
					</div>
					<div class="table">
						<p>The HTML shown below is the raw HTML table element, before it has been enhanced by DataTables:</p>
					</div>
					<div class="css">
						<div>
							<p>This example uses a little bit of additional CSS beyond what is loaded from the library files (below), in order to correctly display the table. The
							additional CSS used is shown below:</p><code class="multiline language-css">th { white-space: nowrap; }</code>
						</div>
						<p>The following CSS library files are loaded for use in this example to provide the styling of the table:</p>
						<ul>
							<li>
								<a href="https://cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css">https://cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css</a>
							</li>
						</ul>
					</div>
					<div class="ajax">
						<p>This table loads data by Ajax. The latest data that has been loaded is shown below. This data will update automatically as any additional data is
						loaded.</p>
					</div>
					<div class="php">
						<p>The script used to perform the server-side processing for this table is shown below. Please note that this is just an example script using PHP.
						Server-side processing scripts can be written in any language, using <a href="//datatables.net/manual/server-side">the protocol described in the DataTables
						documentation</a>.</p>
					</div>
					<div class="comments">
						<div class="comments-insert"></div>
					</div>
				</div>
				<h2>Other examples</h2>
				<div class="toc">
					<div class="toc-group">
						<h3><a href="../basic_init/index.html">Basic initialisation</a></h3>
						<ul class="toc">
							<li>
								<a href="../basic_init/zero_configuration.html">Zero configuration</a>
							</li>
							<li>
								<a href="../basic_init/filter_only.html">Feature enable / disable</a>
							</li>
							<li>
								<a href="../basic_init/table_sorting.html">Default ordering (sorting)</a>
							</li>
							<li>
								<a href="../basic_init/multi_col_sort.html">Multi-column ordering</a>
							</li>
							<li>
								<a href="../basic_init/multiple_tables.html">Multiple tables</a>
							</li>
							<li>
								<a href="../basic_init/hidden_columns.html">Hidden columns</a>
							</li>
							<li>
								<a href="../basic_init/complex_header.html">Complex headers (rowspan and colspan)</a>
							</li>
							<li>
								<a href="../basic_init/dom.html">DOM positioning</a>
							</li>
							<li>
								<a href="../basic_init/flexible_width.html">Flexible table width</a>
							</li>
							<li>
								<a href="../basic_init/state_save.html">State saving</a>
							</li>
							<li>
								<a href="../basic_init/alt_pagination.html">Alternative pagination</a>
							</li>
							<li>
								<a href="../basic_init/scroll_y.html">Scroll - vertical</a>
							</li>
							<li>
								<a href="../basic_init/scroll_y_dynamic.html">Scroll - vertical, dynamic height</a>
							</li>
							<li>
								<a href="../basic_init/scroll_x.html">Scroll - horizontal</a>
							</li>
							<li>
								<a href="../basic_init/scroll_xy.html">Scroll - horizontal and vertical</a>
							</li>
							<li>
								<a href="../basic_init/comma-decimal.html">Language - Comma decimal place</a>
							</li>
							<li>
								<a href="../basic_init/language.html">Language options</a>
							</li>
						</ul>
					</div>
					<div class="toc-group">
						<h3><a href="./index.html">Advanced initialisation</a></h3>
						<ul class="toc active">
							<li>
								<a href="./events_live.html">DOM / jQuery events</a>
							</li>
							<li>
								<a href="./dt_events.html">DataTables events</a>
							</li>
							<li>
								<a href="./column_render.html">Column rendering</a>
							</li>
							<li>
								<a href="./length_menu.html">Page length options</a>
							</li>
							<li>
								<a href="./dom_multiple_elements.html">Multiple table control elements</a>
							</li>
							<li>
								<a href="./complex_header.html">Complex headers with column visibility</a>
							</li>
							<li>
								<a href="./object_dom_read.html">Read HTML to data objects</a>
							</li>
							<li>
								<a href="./html5-data-options.html">HTML5 data-* attributes - table options</a>
							</li>
							<li>
								<a href="./html5-data-attributes.html">HTML5 data-* attributes - cell data</a>
							</li>
							<li>
								<a href="./language_file.html">Language file</a>
							</li>
							<li>
								<a href="./defaults.html">Setting defaults</a>
							</li>
							<li>
								<a href="./row_callback.html">Row created callback</a>
							</li>
							<li>
								<a href="./row_grouping.html">Row grouping</a>
							</li>
							<li class="active">
								<a href="./footer_callback.html">Footer callback</a>
							</li>
							<li>
								<a href="./dom_toolbar.html">Custom toolbar elements</a>
							</li>
							<li>
								<a href="./sort_direction_control.html">Order direction sequence control</a>
							</li>
						</ul>
					</div>
					<div class="toc-group">
						<h3><a href="../styling/index.html">Styling</a></h3>
						<ul class="toc">
							<li>
								<a href="../styling/display.html">Base style</a>
							</li>
							<li>
								<a href="../styling/no-classes.html">Base style - no styling classes</a>
							</li>
							<li>
								<a href="../styling/cell-border.html">Base style - cell borders</a>
							</li>
							<li>
								<a href="../styling/compact.html">Base style - compact</a>
							</li>
							<li>
								<a href="../styling/hover.html">Base style - hover</a>
							</li>
							<li>
								<a href="../styling/order-column.html">Base style - order-column</a>
							</li>
							<li>
								<a href="../styling/row-border.html">Base style - row borders</a>
							</li>
							<li>
								<a href="../styling/stripe.html">Base style - stripe</a>
							</li>
							<li>
								<a href="../styling/bootstrap.html">Bootstrap 3</a>
							</li>
							<li>
								<a href="../styling/foundation.html">Foundation</a>
							</li>
							<li>
								<a href="../styling/jqueryUI.html">jQuery UI ThemeRoller</a>
							</li>
							<li>
								<a href="../styling/bootstrap4.html">Bootstrap 4 (Tech. preview)</a>
							</li>
							<li>
								<a href="../styling/semanticui.html">Semantic UI (Tech. preview)</a>
							</li>
							<li>
								<a href="../styling/material.html">Material Design (Tech. preview)</a>
							</li>
							<li>
								<a href="../styling/uikit.html">UIKit (Tech. preview)</a>
							</li>
						</ul>
					</div>
					<div class="toc-group">
						<h3><a href="../data_sources/index.html">Data sources</a></h3>
						<ul class="toc">
							<li>
								<a href="../data_sources/dom.html">HTML (DOM) sourced data</a>
							</li>
							<li>
								<a href="../data_sources/ajax.html">Ajax sourced data</a>
							</li>
							<li>
								<a href="../data_sources/js_array.html">Javascript sourced data</a>
							</li>
							<li>
								<a href="../data_sources/server_side.html">Server-side processing</a>
							</li>
						</ul>
					</div>
					<div class="toc-group">
						<h3><a href="../api/index.html">API</a></h3>
						<ul class="toc">
							<li>
								<a href="../api/add_row.html">Add rows</a>
							</li>
							<li>
								<a href="../api/multi_filter.html">Individual column searching (text inputs)</a>
							</li>
							<li>
								<a href="../api/multi_filter_select.html">Individual column searching (select inputs)</a>
							</li>
							<li>
								<a href="../api/highlight.html">Highlighting rows and columns</a>
							</li>
							<li>
								<a href="../api/row_details.html">Child rows (show extra / detailed information)</a>
							</li>
							<li>
								<a href="../api/select_row.html">Row selection (multiple rows)</a>
							</li>
							<li>
								<a href="../api/select_single_row.html">Row selection and deletion (single row)</a>
							</li>
							<li>
								<a href="../api/form.html">Form inputs</a>
							</li>
							<li>
								<a href="../api/counter_columns.html">Index column</a>
							</li>
							<li>
								<a href="../api/show_hide.html">Show / hide columns dynamically</a>
							</li>
							<li>
								<a href="../api/api_in_init.html">Using API in callbacks</a>
							</li>
							<li>
								<a href="../api/tabs_and_scrolling.html">Scrolling and Bootstrap tabs</a>
							</li>
							<li>
								<a href="../api/regex.html">Search API (regular expressions)</a>
							</li>
						</ul>
					</div>
					<div class="toc-group">
						<h3><a href="../ajax/index.html">Ajax</a></h3>
						<ul class="toc">
							<li>
								<a href="../ajax/simple.html">Ajax data source (arrays)</a>
							</li>
							<li>
								<a href="../ajax/objects.html">Ajax data source (objects)</a>
							</li>
							<li>
								<a href="../ajax/deep.html">Nested object data (objects)</a>
							</li>
							<li>
								<a href="../ajax/objects_subarrays.html">Nested object data (arrays)</a>
							</li>
							<li>
								<a href="../ajax/orthogonal-data.html">Orthogonal data</a>
							</li>
							<li>
								<a href="../ajax/null_data_source.html">Generated content for a column</a>
							</li>
							<li>
								<a href="../ajax/custom_data_property.html">Custom data source property</a>
							</li>
							<li>
								<a href="../ajax/custom_data_flat.html">Flat array data source</a>
							</li>
							<li>
								<a href="../ajax/defer_render.html">Deferred rendering for speed</a>
							</li>
						</ul>
					</div>
					<div class="toc-group">
						<h3><a href="../server_side/index.html">Server-side</a></h3>
						<ul class="toc">
							<li>
								<a href="../server_side/simple.html">Server-side processing</a>
							</li>
							<li>
								<a href="../server_side/custom_vars.html">Custom HTTP variables</a>
							</li>
							<li>
								<a href="../server_side/post.html">POST data</a>
							</li>
							<li>
								<a href="../server_side/ids.html">Automatic addition of row ID attributes</a>
							</li>
							<li>
								<a href="../server_side/object_data.html">Object data source</a>
							</li>
							<li>
								<a href="../server_side/row_details.html">Row details</a>
							</li>
							<li>
								<a href="../server_side/select_rows.html">Row selection</a>
							</li>
							<li>
								<a href="../server_side/jsonp.html">JSONP data source for remote domains</a>
							</li>
							<li>
								<a href="../server_side/defer_loading.html">Deferred loading of data</a>
							</li>
							<li>
								<a href="../server_side/pipeline.html">Pipelining data to reduce Ajax calls for paging</a>
							</li>
						</ul>
					</div>
					<div class="toc-group">
						<h3><a href="../plug-ins/index.html">Plug-ins</a></h3>
						<ul class="toc">
							<li>
								<a href="../plug-ins/api.html">API plug-in methods</a>
							</li>
							<li>
								<a href="../plug-ins/sorting_auto.html">Ordering plug-ins (with type detection)</a>
							</li>
							<li>
								<a href="../plug-ins/sorting_manual.html">Ordering plug-ins (no type detection)</a>
							</li>
							<li>
								<a href="../plug-ins/range_filtering.html">Custom filtering - range search</a>
							</li>
							<li>
								<a href="../plug-ins/dom_sort.html">Live DOM ordering</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="fw-footer">
			<div class="copyright">
				DataTables designed and created by <a href="//sprymedia.co.uk">SpryMedia Ltd</a> © 2007-2016. <a href="/license/mit">MIT licensed</a>. Our <a href=
				"/supporters">Supporters</a><br>
				SpryMedia Ltd is registered in Scotland, company no. SC456502.
			</div>
		</div>
	</div>
	<script type="text/javascript">
				  var _gaq = _gaq || [];
				  _gaq.push(['_setAccount', 'UA-365466-5']);
				  _gaq.push(['_trackPageview']);

				  (function() {
					var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
					ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
					var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
				  })();
	</script>
</body>
</html>