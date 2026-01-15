<div class="card mb-g">
	<div class="card-body">
		<h2 class="fw-700 mb-g">
			Interface Class
			<small>
			ตำแหน่ง <code>include/iface.php</code>. You can completely slim down your project through the build.json file.
			</small>
		</h2>
		<div class="table-responsive">
		<table class="table table-bordered table-hover">
		<thead>
		<tr>
		<th style="width:260px">
		variable
		</th>
		<th style="width: 100px">
		value
		</th>
		<th>
		description
		</th>
		</tr>
		</thead>
		<tbody>
		<tr>
		<td>
		config.debug
		</td>
		<td>
		<code>boolean</code>
		</td>
		<td>
		spits out debugging data and error messages on npm log file
		</td>
		</tr>
		<tr>
		<td>
		config.data.*
		</td>
		<td>
		<code>string</code>
		</td>
		<td>
		global data for the template, control profile images, user names, etc
		</td>
		</tr>
		<tr>
		<td>
		config.compile.jsUglify
		</td>
		<td>
		<code>boolean</code>
		</td>
		<td>
		minifies all javascript files in the project
		</td>
		</tr>
		<tr>
		<td>
		config.compile.cssMinify
		</td>
		<td>
		<code>boolean</code>
		</td>
		<td>
		minifies all css files in the project
		</td>
		</tr>
		<tr>
		<td>
		config.compile.jsSourcemaps
		</td>
		<td>
		<code>boolean</code>
		</td>
		<td>
		generates js source maps from the scss files for easier debugging options using the browser's inspection tool
		</td>
		</tr>
		<tr>
		<td>
		config.compile.cssSourcemaps
		</td>
		<td>
		<code>boolean</code>
		</td>
		<td>
		generates css source maps from the scss files for easier debugging options using the browser's inspection tool
		</td>
		</tr>
		<tr>
		<td>
		config.compile.autoprefixer
		</td>
		<td>
		<code>boolean</code>
		</td>
		<td>
		we recommend you leave this set to true. This will auto-generate all the necessary CSS browser prefixes for different browser types
		</td>
		</tr>
		<tr>
		<td>
		config.compile.seedOnly
		</td>
		<td>
		<code>boolean</code>
		</td>
		<td>
		generates the seed project navigation menu, all other assets will be intact, can be removed manually (but will not be called into the main project)
		</td>
		</tr>
		<tr>
		<td>
		config.path.*
		</td>
		<td>
		<code>string</code>
		</td>
		<td>
		addresses source and dist path of your porject files, change this if you change your source file path
		</td>
		</tr>
		<tr>
		<td>
		build.vendor.*
		</td>
		<td>
		<code>string</code>
		</td>
		<td>
		link all sources for plugins from the node_modules directory, you can concatinte files here and also rename them if needed
		</td>
		</tr>
		<tr>
		<td>
		build.app.*
		</td>
		<td>
		<code>string</code>
		</td>
		<td>
		concatinates all the main core files for the theme
		</td>
		</tr>
		</tbody>
		</table>
		</div>
	</div>
</div>