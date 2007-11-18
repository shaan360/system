	<?php include('header.php');?>
<div class="container">
<hr>
<div class="column prepend-1 span-22 append-1">
	<h2><?php _e('Habari Content'); ?></h2>
	<p><?php _e('Here you will find all the content you have created, ready to be tweaked, edited or removed.'); ?></p>
	
	<form method="post" action="<?php URL::out('admin', 'page=content'); ?>" class="buttonform">
	
	<p>
	Search post titles and content: 
	<input type="textbox" size="50" name='search' value="<?php echo $search; ?>"> <input type="submit" name="do_search" value="<?php _e('Search'); ?>">
	<?php printf( _t('Limit: %s'), Utils::html_select('limit', $limits, $limit)); ?>
	<?php printf( _t('Page: %s'), Utils::html_select('index', $pages, $index)); ?>
	<a href="<?php URL::out('admin', 'page=content'); ?>">Reset</a>
	</p>
		<table id="post-data-published" width="100%" cellspacing="0">
			<thead>
				<tr>
					<th align="right"> </th>
					<th align="left"><?php _e('Title'); ?></th>
					<th align="left"><?php _e('Author'); ?></th>
					<th align="left"><?php _e('Published'); ?></th>
					<th align="left"><?php _e('Type'); ?></th>
					<th align="left"><?php _e('Status'); ?></th>
					<th align="center"> </th>
				</tr>
			</thead>
			<tr>
				<td class="span-1"></td>
				<td class="span-5"></td>
				<td class="span-3"><?php echo Utils::html_select('author', $authors, $author,array( 'class'=>'longselect')); ?></td>
				<td class="span-3"><?php echo Utils::html_select('year_month', $dates, $year_month, array( 'class'=>'longselect')); ?></td>
				<td class="span-3"><?php echo Utils::html_select('type', array_flip(Post::list_active_post_types()), $type, array( 'class'=>'longselect')); ?></td>
				<td class="span-3"><?php echo Utils::html_select('status', array_flip(Post::list_post_statuses( false )), $status, array( 'class'=>'longselect')); ?></td>
				<td class="span-3 last"><input type="submit" name="filter" value="<?php _e('Filter'); ?>"></td>
			</tr>
			<?php foreach ( $posts as $post ) : ?>
			<tr>
				<td class="span-1"><input type="checkbox" name="post_ids[]" value="<?php echo $post->id; ?>"></td>
				<td class="span-5"><?php echo '<a href="' . $post->permalink . '">' . Utils::truncate( $post->title, 32, false ); ?></a></td>
				<td class="span-3"><?php echo $post->author->username ?></td>
				<td class="span-3"><?php echo $post->pubdate ?></td>
				<td class="span-3"><?php _e( Post::type_name( $post->content_type ) ); ?></td>
				<td class="span-3"><?php _e( Post::status_name( $post->status ) ); ?></td>
				<td class="span-3 last">
					<a class="edit" href="<?php URL::out('admin', 'page=publish&slug=' . $post->slug); ?>" title="Edit this entry">
						Edit
					</a>
				</td>
			</tr>
			<?php endforeach; ?>
		<tr><td colspan="7">
		<input type="hidden" name="nonce" value="<?php echo $wsse['nonce']; ?>">
		<input type="hidden" name="timestamp" value="<?php echo $wsse['timestamp']; ?>">
		<input type="hidden" name="PasswordDigest" value="<?php echo $wsse['digest']; ?>">
		Selected posts: &nbsp;&nbsp;<select name="change" class="longselect">
		<option value="unpublish"><?php _e('Unpublish'); ?></option>
		<option value="publish"><?php _e('Publish'); ?></option>
		<option value="delete"><?php _e('Delete'); ?></option>
		</select>
		<input type="submit" name="do_update" value="<?php _e('Update'); ?>">
		</form>
		</td></tr>
		</table>
	
</div></div>
<?php include('footer.php');?>
