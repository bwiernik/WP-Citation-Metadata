<?php
/**
 * Functions for adding citation metadata boxes to specified WordPress page types using the
 * MetaBox plugin. Defaults to showing citation metadata boxes on 'page' and 'post' types.
 * 
 * To use with Easy Digital Downloads, change 'post_types' to:
 * 'post_types' => apply_filters( 'edd_download_metabox_post_types' , array( 'download' ) ),
 *
 * These citation boxes provide metadata tags that are recognized by Google Scholar, Zotero,
 * and other scholarly reference tools. They also display some metadata tags (e.g.,
 * 'citation_editor'; 'citation_publisher_place') that are not currently widely supported.
 *
 * Author: Brenton M. Wiernik
 * Last modified: 05-07-2017
 * 
 */

add_filter( 'rwmb_meta_boxes', 'citation_register_meta_boxes' );

/**
 * Register meta boxes
 *
 * @param array $meta_boxes List of meta boxes
 *
 * @return array
 */
function citation_register_meta_boxes( $meta_boxes ) {
  $prefix = 'citation_';

  $meta_boxes[] = array(
    'id'         => 'citation_basic',
    'title'      => esc_html__( 'Basic Citation Metadata', 'citation' ),
    // Set the post types that citation metaboxes will show on (e.g., post, page, download)
    'post_types' => array( 'post', 'page' ),
    'context'    => 'normal',
    'priority'   => 'high',
    'autosave'   => true,

    // List of meta fields
    'fields'     => array(
      // TEXT - Title
      array(
        // Field name - Will be used as label
        'name'  => esc_html__( 'Item Title', 'citation' ),
        // Label description, display below field name (optional).
        //'label_description' => esc_html__( 'Main title of the item', 'citation' ),
        // Field ID, i.e. the meta key
        'id'    => "{$prefix}title",
        // Field description (optional)
        //'desc'  => esc_html__( 'Text description', 'citation' ),
        'type'  => 'text',
        // Default value (optional)
        // 'std'   => esc_html__( '', 'citation' ),
        // CLONES: Add to make the field cloneable (i.e. have multiple value)
        'size'  => 50,
        'clone' => false,
      ),
      // TEXT - Author
      array(
        // Field name - Will be used as label
        'name'  => esc_html__( 'Author', 'citation' ),
        // Label description, display below field name (optional).
        'label_description' => esc_html__( 'Enter authors in order as: Smith, John P., Jr.', 'citation' ),
        // Field ID, i.e. the meta key
        'id'    => "{$prefix}author",
        // Field description (optional)
        //'desc'  => esc_html__( 'Smith, John P.', 'citation' ),
        'type'  => 'text',
        // Default value (optional)
        // 'std'   => esc_html__( '', 'citation' ),
        // CLONES: Add to make the field cloneable (i.e. have multiple value)
        'clone' => true,
      ),
      // TEXT - Year
      array(
        // Field name - Will be used as label
        'name'  => esc_html__( 'Publication Date', 'citation' ),
        // Label description, display below field name (optional).
        //'label_description' => esc_html__( 'Date of publication', 'citation' ),
        // Field ID, i.e. the meta key
        'id'    => "{$prefix}publication_date",
        // Field description (optional)
        'desc'  => esc_html__( '2015/04/30', 'citation' ),
        'type'  => 'text',
        // Default value (optional)
        // 'std'   => esc_html__( '', 'citation' ),
        // CLONES: Add to make the field cloneable (i.e. have multiple value)
        'size'  => 10,
        'clone' => false,
      ),
      // TEXTAREA - Abstract
      array(
        'name' => esc_html__( 'Abstract', 'citation' ),
        //'desc' => esc_html__( 'Textarea description', 'citation' ),
        'id'   => "{$prefix}abstract",
        'type' => 'textarea',
        'cols' => 20,
        'rows' => 3,
        'clone' => false,
      ),
      // TEXT - DOI
      array(
        // Field name - Will be used as label
        'name'  => esc_html__( 'DOI', 'citation' ),
        // Label description, display below field name (optional).
        //'label_description' => esc_html__( 'Main title of the item', 'citation' ),
        // Field ID, i.e. the meta key
        'id'    => "{$prefix}doi",
        // Field description (optional)
        //'desc'  => esc_html__( 'Text description', 'citation' ),
        'type'  => 'text',
        // Default value (optional)
        // 'std'   => esc_html__( '', 'citation' ),
        // CLONES: Add to make the field cloneable (i.e. have multiple value)
        'size'  => 50,
        'clone' => false,
      ),
      // TEXT - First Page
      array(
        // Field name - Will be used as label
        'name'  => esc_html__( 'First Page', 'citation' ),
        // Label description, display below field name (optional).
        //'label_description' => esc_html__( 'Enter authors in order', 'citation' ),
        // Field ID, i.e. the meta key
        'id'    => "{$prefix}firstpage",
        // Field description (optional)
        //'desc'  => esc_html__( 'Smith, John P.', 'citation' ),
        'type'  => 'text',
        // Default value (optional)
        // 'std'   => esc_html__( '', 'citation' ),
        // CLONES: Add to make the field cloneable (i.e. have multiple value)
        'size'  => 5,
        'clone' => false,
      ),
      // TEXT - Last Page
      array(
        // Field name - Will be used as label
        'name'  => esc_html__( 'Last Page', 'citation' ),
        // Label description, display below field name (optional).
        //'label_description' => esc_html__( 'Enter authors in order', 'citation' ),
        // Field ID, i.e. the meta key
        'id'    => "{$prefix}lastpage",
        // Field description (optional)
        //'desc'  => esc_html__( 'Smith, John P.', 'citation' ),
        'type'  => 'text',
        // Default value (optional)
        // 'std'   => esc_html__( '', 'citation' ),
        // CLONES: Add to make the field cloneable (i.e. have multiple value)
        'size'  => 5,
        'clone' => false,
      ),
      // TEXT - PDF URL
      // TODO: Fill this automatically
      array(
        // Field name - Will be used as label
        'name'  => esc_html__( 'PDF URL', 'citation' ),
        // Label description, display below field name (optional).
        'desc' => esc_html__( 'URL for the PDF', 'citation' ),
        // Field ID, i.e. the meta key
        'id'    => "{$prefix}pdf_url",
        // Field description (optional)
        //'desc'  => esc_html__( '2015/04/30', 'citation' ),
        'type'  => 'text',
        // Default value (optional)
        // 'std'   => esc_html__( '', 'citation' ),
        // CLONES: Add to make the field cloneable (i.e. have multiple value)
        'size'  => 60,
        'clone' => false,
      ),
    ),
    'validation' => array(
      'rules'    => array(
        "{$prefix}title" => array(
          'required'  => true,
        ),
        "{$prefix}author" => array(
          'required'  => true,
        ),
        "{$prefix}publication_date" => array(
          'required'  => true,
        ),
        "{$prefix}pdf_url" => array(
          'required'  => true,
        ),
      ),
    ),
  );      

  $meta_boxes[] = array(
    'id'         => 'citation_journal',
    'title'      => esc_html__( 'Journal Article', 'citation' ),
    // Set the post types that citation metaboxes will show on (e.g., post, page, download)
    'post_types' => array( 'post', 'page' ),
    'context'    => 'normal',
    'priority'   => 'high',
    'autosave'   => true,

    // List of meta fields
    'fields'     => array(
      // TEXT - Journal Title
      array(
        // Field name - Will be used as label
        'name'  => esc_html__( 'Journal Title', 'citation' ),
        // Label description, display below field name (optional).
        //'label_description' => esc_html__( 'Main title of the item', 'citation' ),
        // Field ID, i.e. the meta key
        'id'    => "{$prefix}journal_title",
        // Field description (optional)
        //'desc'  => esc_html__( 'Text description', 'citation' ),
        'type'  => 'text',
        // Default value (optional)
        // 'std'   => esc_html__( '', 'citation' ),
        // CLONES: Add to make the field cloneable (i.e. have multiple value)
        'size'  => 30,
        'clone' => false,
      ),
      // TEXT - Volume
      array(
        // Field name - Will be used as label
        'name'  => esc_html__( 'Volume', 'citation' ),
        // Label description, display below field name (optional).
        //'label_description' => esc_html__( 'Enter authors in order', 'citation' ),
        // Field ID, i.e. the meta key
        'id'    => "{$prefix}journal_volume",
        // Field description (optional)
        //'desc'  => esc_html__( 'Smith, John P.', 'citation' ),
        'type'  => 'text',
        // Default value (optional)
        // 'std'   => esc_html__( '', 'citation' ),
        // CLONES: Add to make the field cloneable (i.e. have multiple value)
        'size'  => 5,
        'clone' => false,
      ),
      // TEXT - Issue
      array(
        // Field name - Will be used as label
        'name'  => esc_html__( 'Issue', 'citation' ),
        // Label description, display below field name (optional).
        //'label_description' => esc_html__( 'Enter authors in order', 'citation' ),
        // Field ID, i.e. the meta key
        'id'    => "{$prefix}issue",
        // Field description (optional)
        //'desc'  => esc_html__( 'Smith, John P.', 'citation' ),
        'type'  => 'text',
        // Default value (optional)
        // 'std'   => esc_html__( '', 'citation' ),
        // CLONES: Add to make the field cloneable (i.e. have multiple value)
        'size'  => 5,
        'clone' => false,
      ),
      // TEXT - Journal Abbreviation
      array(
        // Field name - Will be used as label
        'name'  => esc_html__( 'Journal Abbreviation', 'citation' ),
        // Label description, display below field name (optional).
        //'label_description' => esc_html__( 'Abbreviation for Journal', 'citation' ),
        // Field ID, i.e. the meta key
        'id'    => "{$prefix}journal_abbreviation",
        // Field description (optional)
        'desc'  => esc_html__( 'J. Appl. Psychol.', 'citation' ),
        'type'  => 'text',
        // Default value (optional)
        // 'std'   => esc_html__( '', 'citation' ),
        // CLONES: Add to make the field cloneable (i.e. have multiple value)
        'size'  => 20,
        'clone' => false,
      ),
      // TEXT - ISSN
      array(
        // Field name - Will be used as label
        'name'  => esc_html__( 'Journal ISSN', 'citation' ),
        // Label description, display below field name (optional).
        'label_description' => esc_html__( 'Separate print/electronic ISSNs with comma', 'citation' ),
        // Field ID, i.e. the meta key
        'id'    => "{$prefix}journal_issn",
        // Field description (optional)
        'desc'  => esc_html__( '1234-5678, 0000-3456', 'citation' ),
        'type'  => 'text',
        // Default value (optional)
        // 'std'   => esc_html__( '', 'citation' ),
        // CLONES: Add to make the field cloneable (i.e. have multiple value)
        'size'  => 20,
        'clone' => false,
      ),
      // HEADING - Series/Special Issues
      array(
        'name'  => esc_html__( 'Special Issue/Section', 'citation' ),
        'type'  => 'heading',
      ),
      // TEXT - Series/Special Issue/Special Section
      array(
        // Field name - Will be used as label
        'name'  => esc_html__( 'Special Issue or Section', 'citation' ),
        // Label description, display below field name (optional).
        //'label_description' => esc_html__( 'Title of special issue or section', 'citation' ),
        // Field ID, i.e. the meta key
        'id'    => "{$prefix}special_issue",
        // Field description (optional)
        'desc'  => esc_html__( 'Special issue: Title of special issue', 'citation' ),
        'type'  => 'text',
        // Default value (optional)
        // 'std'   => esc_html__( '', 'citation' ),
        // CLONES: Add to make the field cloneable (i.e. have multiple value)
        'size'  => 50,
        'clone' => false,
      ),
    ),
  );

  $meta_boxes[] = array(
    'id'         => 'citation_book',
    'title'      => esc_html__( 'Book or Chapter', 'citation' ),
    // Set the post types that citation metaboxes will show on (e.g., post, page, download)
    'post_types' => array( 'post', 'page' ),
    'context'    => 'normal',
    'priority'   => 'high',
    'autosave'   => true,

    // List of meta fields
    'fields'     => array(
      // TEXT - Book Title
      array(
        // Field name - Will be used as label
        'name'  => esc_html__( 'Book Title', 'citation' ),
        // Label description, display below field name (optional).
        //'label_description' => esc_html__( 'Main title of the item', 'citation' ),
        // Field ID, i.e. the meta key
        'id'    => "{$prefix}book_title",
        // Field description (optional)
        //'desc'  => esc_html__( 'Text description', 'citation' ),
        'type'  => 'text',
        // Default value (optional)
        // 'std'   => esc_html__( '', 'citation' ),
        // CLONES: Add to make the field cloneable (i.e. have multiple value)
        'size'  => 50,
        'clone' => false,
      ),
      // TEXT - Editor
      array(
        // Field name - Will be used as label
        'name'  => esc_html__( 'Editor', 'citation' ),
        // Label description, display below field name (optional).
        'label_description' => esc_html__( 'Enter editors in order as: Smith, John P., Jr.', 'citation' ),
        // Field ID, i.e. the meta key
        'id'    => "{$prefix}book_editor",
        // Field description (optional)
        //'desc'  => esc_html__( 'Smith, John P.', 'citation' ),
        'type'  => 'text',
        // Default value (optional)
        // 'std'   => esc_html__( '', 'citation' ),
        // CLONES: Add to make the field cloneable (i.e. have multiple value)
        'clone' => true,
      ),
      // TEXT - Volume
      array(
        // Field name - Will be used as label
        'name'  => esc_html__( 'Volume', 'citation' ),
        // Label description, display below field name (optional).
        //'label_description' => esc_html__( 'Enter authors in order', 'citation' ),
        // Field ID, i.e. the meta key
        'id'    => "{$prefix}book_volume",
        // Field description (optional)
        //'desc'  => esc_html__( 'Smith, John P.', 'citation' ),
        'type'  => 'text',
        // Default value (optional)
        // 'std'   => esc_html__( '', 'citation' ),
        // CLONES: Add to make the field cloneable (i.e. have multiple value)
        'size'  => 5,
        'clone' => false,
      ),
      // TEXT - Publisher
      array(
        // Field name - Will be used as label
        'name'  => esc_html__( 'Publisher', 'citation' ),
        // Label description, display below field name (optional).
        //'label_description' => esc_html__( 'Separate print and electronic ISSNs with comma', 'citation' ),
        // Field ID, i.e. the meta key
        'id'    => "{$prefix}book_publisher",
        // Field description (optional)
        //'desc'  => esc_html__( '1234-5678, 0000-3456', 'citation' ),
        'type'  => 'text',
        // Default value (optional)
        // 'std'   => esc_html__( '', 'citation' ),
        // CLONES: Add to make the field cloneable (i.e. have multiple value)
        'size'  => 20,
        'clone' => false,
      ),
      // TEXT - Publisher Place
      array(
        // Field name - Will be used as label
        'name'  => esc_html__( 'Publisher Location', 'citation' ),
        // Label description, display below field name (optional).
        //'label_description' => esc_html__( 'Separate print and electronic ISSNs with comma', 'citation' ),
        // Field ID, i.e. the meta key
        'id'    => "{$prefix}book_publisher_place",
        // Field description (optional)
        //'desc'  => esc_html__( '1234-5678, 0000-3456', 'citation' ),
        'type'  => 'text',
        // Default value (optional)
        // 'std'   => esc_html__( '', 'citation' ),
        // CLONES: Add to make the field cloneable (i.e. have multiple value)
        'size'  => 30,
        'clone' => false,
      ),
      // TEXT - ISBN
      array(
        // Field name - Will be used as label
        'name'  => esc_html__( 'ISBN', 'citation' ),
        // Label description, display below field name (optional).
        //'label_description' => esc_html__( 'Title of book series', 'citation' ),
        // Field ID, i.e. the meta key
        'id'    => "{$prefix}book_isbn",
        // Field description (optional)
        //'desc'  => esc_html__( 'Special issue: Title of special issue', 'citation' ),
        'type'  => 'text',
        // Default value (optional)
        // 'std'   => esc_html__( '', 'citation' ),
        // CLONES: Add to make the field cloneable (i.e. have multiple value)
        'size'  => 20,
        'clone' => false,
      ),
      // TEXT - Edition
      array(
        // Field name - Will be used as label
        'name'  => esc_html__( 'Edition', 'citation' ),
        // Label description, display below field name (optional).
        //'label_description' => esc_html__( 'Title of book series', 'citation' ),
        // Field ID, i.e. the meta key
        'id'    => "{$prefix}edition",
        // Field description (optional)
        //'desc'  => esc_html__( 'Special issue: Title of special issue', 'citation' ),
        'type'  => 'text',
        // Default value (optional)
        // 'std'   => esc_html__( '', 'citation' ),
        // CLONES: Add to make the field cloneable (i.e. have multiple value)
        'size'  => 10,
        'clone' => false,
      ),
      // TEXT - Chapter Number
      array(
        // Field name - Will be used as label
        'name'  => esc_html__( 'Chapter Number', 'citation' ),
        // Label description, display below field name (optional).
        //'label_description' => esc_html__( 'Title of book series', 'citation' ),
        // Field ID, i.e. the meta key
        'id'    => "{$prefix}chapter_number",
        // Field description (optional)
        //'desc'  => esc_html__( 'Special issue: Title of special issue', 'citation' ),
        'type'  => 'text',
        // Default value (optional)
        // 'std'   => esc_html__( '', 'citation' ),
        // CLONES: Add to make the field cloneable (i.e. have multiple value)
        'size'  => 5,
        'clone' => false,
      ),
      // HEADING - Series
      array(
        'name'  => esc_html__( 'Book Series', 'citation' ),
        'type'  => 'heading',
      ),
      // TEXT - Series/Special Issue/Special Section
      array(
        // Field name - Will be used as label
        'name'  => esc_html__( 'Series', 'citation' ),
        // Label description, display below field name (optional).
        //'label_description' => esc_html__( 'Title of special issue or section', 'citation' ),
        // Field ID, i.e. the meta key
        'id'    => "{$prefix}book_series_title",
        // Field description (optional)
        'desc'  => esc_html__( 'Title of book series', 'citation' ),
        'type'  => 'text',
        // Default value (optional)
        // 'std'   => esc_html__( '', 'citation' ),
        // CLONES: Add to make the field cloneable (i.e. have multiple value)
        'size'  => 50,
        'clone' => false,
      ),
      // TEXT - Series Number
      array(
        // Field name - Will be used as label
        'name'  => esc_html__( 'Series Number', 'citation' ),
        // Field ID, i.e. the meta key
        'id'    => "{$prefix}book_series_number",
        // Field description (optional)
        //'desc'  => esc_html__( 'Special issue: Title of special issue', 'citation' ),
        'type'  => 'text',
        // Default value (optional)
        // 'std'   => esc_html__( '', 'citation' ),
        // CLONES: Add to make the field cloneable (i.e. have multiple value)
        'size'  => 5,
        'clone' => false,
      ),
      // TEXT - ISSN
      array(
        // Field name - Will be used as label
        'name'  => esc_html__( 'Series ISSN', 'citation' ),
        // Label description, display below field name (optional).
        'label_description' => esc_html__( 'Separate print/electronic ISSNs with comma', 'citation' ),
        // Field ID, i.e. the meta key
        'id'    => "{$prefix}book_issn",
        // Field description (optional)
        'desc'  => esc_html__( '1234-5678, 0000-3456', 'citation' ),
        'type'  => 'text',
        // Default value (optional)
        // 'std'   => esc_html__( '', 'citation' ),
        // CLONES: Add to make the field cloneable (i.e. have multiple value)
        'size'  => 20,
        'clone' => false,
      ),
    ),
  );

  $meta_boxes[] = array(
    'id'         => 'citation_technical_report',
    'title'      => esc_html__( 'Technical Report/Working Paper', 'citation' ),
    // Set the post types that citation metaboxes will show on (e.g., post, page, download)
    'post_types' => array( 'post', 'page' ),
    'context'    => 'normal',
    'priority'   => 'high',
    'autosave'   => true,

    // List of meta fields
    'fields'     => array(
      // TEXT - Report Type
      array(
        // Field name - Will be used as label
        'name'  => esc_html__( 'Report Type', 'citation' ),
        // Label description, display below field name (optional).
        //'label_description' => esc_html__( 'Main title of the item', 'citation' ),
        // Field ID, i.e. the meta key
        'id'    => "{$prefix}technical_report_name",
        // Field description (optional)
        //'desc'  => esc_html__( 'Text description', 'citation' ),
        'type'  => 'text',
        // Default value (optional)
        // 'std'   => esc_html__( '', 'citation' ),
        // CLONES: Add to make the field cloneable (i.e. have multiple value)
        'size'  => 20,
        'clone' => false,
      ),
      // TEXT - Report Number
      array(
        // Field name - Will be used as label
        'name'  => esc_html__( 'Report Number', 'citation' ),
        // Label description, display below field name (optional).
        //'label_description' => esc_html__( 'Separate print and electronic ISSNs with comma', 'citation' ),
        // Field ID, i.e. the meta key
        'id'    => "{$prefix}technical_report_number",
        // Field description (optional)
        //'desc'  => esc_html__( '1234-5678, 0000-3456', 'citation' ),
        'type'  => 'text',
        // Default value (optional)
        // 'std'   => esc_html__( '', 'citation' ),
        // CLONES: Add to make the field cloneable (i.e. have multiple value)
        'size'  => 10,
        'clone' => false,
      ),
      // TEXT - Technical Report Institution
      array(
        // Field name - Will be used as label
        'name'  => esc_html__( 'Publisher', 'citation' ),
        // Label description, display below field name (optional).
        //'label_description' => esc_html__( 'Separate print and electronic ISSNs with comma', 'citation' ),
        // Field ID, i.e. the meta key
        'id'    => "{$prefix}technical_report_institution",
        // Field description (optional)
        //'desc'  => esc_html__( '1234-5678, 0000-3456', 'citation' ),
        'type'  => 'text',
        // Default value (optional)
        // 'std'   => esc_html__( '', 'citation' ),
        // CLONES: Add to make the field cloneable (i.e. have multiple value)
        'size'  => 30,
        'clone' => false,
      ),
      // TEXT - Technical Report Institution Place
      array(
        // Field name - Will be used as label
        'name'  => esc_html__( 'Publisher Location', 'citation' ),
        // Label description, display below field name (optional).
        //'label_description' => esc_html__( 'Separate print and electronic ISSNs with comma', 'citation' ),
        // Field ID, i.e. the meta key
        'id'    => "{$prefix}technical_report_institution_place",
        // Field description (optional)
        //'desc'  => esc_html__( '1234-5678, 0000-3456', 'citation' ),
        'type'  => 'text',
        // Default value (optional)
        // 'std'   => esc_html__( '', 'citation' ),
        // CLONES: Add to make the field cloneable (i.e. have multiple value)
        'size'  => 30,
        'clone' => false,
      ),
      // TEXT - ISBN
      array(
        // Field name - Will be used as label
        'name'  => esc_html__( 'ISBN', 'citation' ),
        // Label description, display below field name (optional).
        //'label_description' => esc_html__( 'Title of book series', 'citation' ),
        // Field ID, i.e. the meta key
        'id'    => "{$prefix}report_isbn",
        // Field description (optional)
        //'desc'  => esc_html__( 'Special issue: Title of special issue', 'citation' ),
        'type'  => 'text',
        // Default value (optional)
        // 'std'   => esc_html__( '', 'citation' ),
        // CLONES: Add to make the field cloneable (i.e. have multiple value)
        'size'  => 20,
        'clone' => false,
      ),

      // HEADING - Multi-chapter Report
      array(
        'name'  => esc_html__( 'Multi-chapter Report', 'citation' ),
        'type'  => 'heading',
      ),
      // TEXT - Parent Report Title
      array(
        // Field name - Will be used as label
        'name'  => esc_html__( 'Parent Report Title', 'citation' ),
        // Label description, display below field name (optional).
        'label_description' => esc_html__( 'Title of larger report containing the chapter', 'citation' ),
        // Field ID, i.e. the meta key
        'id'    => "{$prefix}parent_report_title",
        // Field description (optional)
        //'desc'  => esc_html__( 'Text description', 'citation' ),
        'type'  => 'text',
        // Default value (optional)
        // 'std'   => esc_html__( '', 'citation' ),
        // CLONES: Add to make the field cloneable (i.e. have multiple value)
        'size'  => 50,
        'clone' => false,
      ),
      // TEXT - Editor
      array(
        // Field name - Will be used as label
        'name'  => esc_html__( 'Editor', 'citation' ),
        // Label description, display below field name (optional).
        'label_description' => esc_html__( 'Enter editors in order as: Smith, John P., Jr.', 'citation' ),
        // Field ID, i.e. the meta key
        'id'    => "{$prefix}report_editor",
        // Field description (optional)
        //'desc'  => esc_html__( 'Smith, John P.', 'citation' ),
        'type'  => 'text',
        // Default value (optional)
        // 'std'   => esc_html__( '', 'citation' ),
        // CLONES: Add to make the field cloneable (i.e. have multiple value)
        'clone' => true,
      ),
      
      // HEADING - Series
      array(
        'name'  => esc_html__( 'Report Series', 'citation' ),
        'type'  => 'heading',
      ),
      // TEXT - Series/Special Issue/Special Section
      array(
        // Field name - Will be used as label
        'name'  => esc_html__( 'Series', 'citation' ),
        // Label description, display below field name (optional).
        //'label_description' => esc_html__( 'Title of special issue or section', 'citation' ),
        // Field ID, i.e. the meta key
        'id'    => "{$prefix}report_series_title",
        // Field description (optional)
        'desc'  => esc_html__( 'Title of report series', 'citation' ),
        'type'  => 'text',
        // Default value (optional)
        // 'std'   => esc_html__( '', 'citation' ),
        // CLONES: Add to make the field cloneable (i.e. have multiple value)
        'size'  => 50,
        'clone' => false,
      ),
      // TEXT - Series Number
      array(
        // Field name - Will be used as label
        'name'  => esc_html__( 'Series Number', 'citation' ),
        // Field ID, i.e. the meta key
        'id'    => "{$prefix}report_series_number",
        // Field description (optional)
        //'desc'  => esc_html__( 'Special issue: Title of special issue', 'citation' ),
        'type'  => 'text',
        // Default value (optional)
        // 'std'   => esc_html__( '', 'citation' ),
        // CLONES: Add to make the field cloneable (i.e. have multiple value)
        'size'  => 5,
        'clone' => false,
      ),
      // TEXT - ISSN
      array(
        // Field name - Will be used as label
        'name'  => esc_html__( 'Series ISSN', 'citation' ),
        // Label description, display below field name (optional).
        'label_description' => esc_html__( 'Separate print/electronic ISSNs with comma', 'citation' ),
        // Field ID, i.e. the meta key
        'id'    => "{$prefix}report_issn",
        // Field description (optional)
        'desc'  => esc_html__( '1234-5678, 0000-3456', 'citation' ),
        'type'  => 'text',
        // Default value (optional)
        // 'std'   => esc_html__( '', 'citation' ),
        // CLONES: Add to make the field cloneable (i.e. have multiple value)
        'size'  => 20,
        'clone' => false,
      ),
    ),
  );

  $meta_boxes[] = array(
    'id'         => 'citation_conference',
    'title'      => esc_html__( 'Conference Paper', 'citation' ),
    // Set the post types that citation metaboxes will show on (e.g., post, page, download)
    'post_types' => array( 'post', 'page' ),
    'context'    => 'normal',
    'priority'   => 'high',
    'autosave'   => true,

    // List of meta fields
    'fields'     => array(
      // TEXT - Conference Title
      array(
        // Field name - Will be used as label
        'name'  => esc_html__( 'Conference Title', 'citation' ),
        // Label description, display below field name (optional).
        //'label_description' => esc_html__( 'Main title of the item', 'citation' ),
        // Field ID, i.e. the meta key
        'id'    => "{$prefix}conference_title",
        // Field description (optional)
        //'desc'  => esc_html__( 'Text description', 'citation' ),
        'type'  => 'text',
        // Default value (optional)
        // 'std'   => esc_html__( '', 'citation' ),
        // CLONES: Add to make the field cloneable (i.e. have multiple value)
        'size'  => 30,
        'clone' => false,
      ),
      // TEXT - Conference Place
      array(
        // Field name - Will be used as label
        'name'  => esc_html__( 'Conference Location', 'citation' ),
        // Label description, display below field name (optional).
        //'label_description' => esc_html__( 'Separate print and electronic ISSNs with comma', 'citation' ),
        // Field ID, i.e. the meta key
        'id'    => "{$prefix}conference_place",
        // Field description (optional)
        //'desc'  => esc_html__( '1234-5678, 0000-3456', 'citation' ),
        'type'  => 'text',
        // Default value (optional)
        // 'std'   => esc_html__( '', 'citation' ),
        // CLONES: Add to make the field cloneable (i.e. have multiple value)
        'size'  => 30,
        'clone' => false,
      ),
      // TEXT - Conference Date
      array(
        // Field name - Will be used as label
        'name'  => esc_html__( 'Conference Date', 'citation' ),
        // Label description, display below field name (optional).
        //'label_description' => esc_html__( 'Separate print and electronic ISSNs with comma', 'citation' ),
        // Field ID, i.e. the meta key
        'id'    => "{$prefix}conference_date",
        // Field description (optional)
        'desc'  => esc_html__( '2016/04/30', 'citation' ),
        'type'  => 'text',
        // Default value (optional)
        // 'std'   => esc_html__( '', 'citation' ),
        // CLONES: Add to make the field cloneable (i.e. have multiple value)
        'size'  => 10,
        'clone' => false,
      ),

      // HEADING - Published Proceedings
      array(
        'name'  => esc_html__( 'Published Proceedings', 'citation' ),
        'type'  => 'heading',
      ),
      // TEXT - Proceedings Title
      array(
        // Field name - Will be used as label
        'name'  => esc_html__( 'Proceedings Title', 'citation' ),
        // Label description, display below field name (optional).
        //'label_description' => esc_html__( 'Main title of the item', 'citation' ),
        // Field ID, i.e. the meta key
        'id'    => "{$prefix}conference_proceedings_title",
        // Field description (optional)
        //'desc'  => esc_html__( 'Text description', 'citation' ),
        'type'  => 'text',
        // Default value (optional)
        // 'std'   => esc_html__( '', 'citation' ),
        // CLONES: Add to make the field cloneable (i.e. have multiple value)
        'size'  => 50,
        'clone' => false,
      ),
      // TEXT - Editor
      array(
        // Field name - Will be used as label
        'name'  => esc_html__( 'Editor', 'citation' ),
        // Label description, display below field name (optional).
        'label_description' => esc_html__( 'Enter editors in order as: Smith, John P., Jr.', 'citation' ),
        // Field ID, i.e. the meta key
        'id'    => "{$prefix}conference_proceedings_editor",
        // Field description (optional)
        //'desc'  => esc_html__( 'Smith, John P.', 'citation' ),
        'type'  => 'text',
        // Default value (optional)
        // 'std'   => esc_html__( '', 'citation' ),
        // CLONES: Add to make the field cloneable (i.e. have multiple value)
        'clone' => true,
      ),
      // TEXT - Volume
      array(
        // Field name - Will be used as label
        'name'  => esc_html__( 'Volume', 'citation' ),
        // Label description, display below field name (optional).
        //'label_description' => esc_html__( 'Enter authors in order', 'citation' ),
        // Field ID, i.e. the meta key
        'id'    => "{$prefix}conference_proceedings_volume",
        // Field description (optional)
        //'desc'  => esc_html__( 'Smith, John P.', 'citation' ),
        'type'  => 'text',
        // Default value (optional)
        // 'std'   => esc_html__( '', 'citation' ),
        // CLONES: Add to make the field cloneable (i.e. have multiple value)
        'size'  => 5,
        'clone' => false,
      ),
      // TEXT - Publisher
      array(
        // Field name - Will be used as label
        'name'  => esc_html__( 'Publisher', 'citation' ),
        // Label description, display below field name (optional).
        //'label_description' => esc_html__( 'Separate print and electronic ISSNs with comma', 'citation' ),
        // Field ID, i.e. the meta key
        'id'    => "{$prefix}conference_proceedings_publisher",
        // Field description (optional)
        //'desc'  => esc_html__( '1234-5678, 0000-3456', 'citation' ),
        'type'  => 'text',
        // Default value (optional)
        // 'std'   => esc_html__( '', 'citation' ),
        // CLONES: Add to make the field cloneable (i.e. have multiple value)
        'size'  => 20,
        'clone' => false,
      ),
      // TEXT - Publisher Place
      array(
        // Field name - Will be used as label
        'name'  => esc_html__( 'Publisher Location', 'citation' ),
        // Label description, display below field name (optional).
        //'label_description' => esc_html__( 'Separate print and electronic ISSNs with comma', 'citation' ),
        // Field ID, i.e. the meta key
        'id'    => "{$prefix}conference_proceedings_publisher_place",
        // Field description (optional)
        //'desc'  => esc_html__( '1234-5678, 0000-3456', 'citation' ),
        'type'  => 'text',
        // Default value (optional)
        // 'std'   => esc_html__( '', 'citation' ),
        // CLONES: Add to make the field cloneable (i.e. have multiple value)
        'size'  => 30,
        'clone' => false,
      ),
      // TEXT - ISBN
      array(
        // Field name - Will be used as label
        'name'  => esc_html__( 'ISBN', 'citation' ),
        // Label description, display below field name (optional).
        //'label_description' => esc_html__( 'Title of book series', 'citation' ),
        // Field ID, i.e. the meta key
        'id'    => "{$prefix}conference_proceedings_isbn",
        // Field description (optional)
        //'desc'  => esc_html__( 'Special issue: Title of special issue', 'citation' ),
        'type'  => 'text',
        // Default value (optional)
        // 'std'   => esc_html__( '', 'citation' ),
        // CLONES: Add to make the field cloneable (i.e. have multiple value)
        'size'  => 20,
        'clone' => false,
      ),
      
      // HEADING - Series
      array(
        'name'  => esc_html__( 'Series', 'citation' ),
        'type'  => 'heading',
      ),
      // TEXT - Series/Special Issue/Special Section
      array(
        // Field name - Will be used as label
        'name'  => esc_html__( 'Series', 'citation' ),
        // Label description, display below field name (optional).
        //'label_description' => esc_html__( 'Title of special issue or section', 'citation' ),
        // Field ID, i.e. the meta key
        'id'    => "{$prefix}conference_proceedings_series_title",
        // Field description (optional)
        'desc'  => esc_html__( 'Title of lecture or proceedings series', 'citation' ),
        'type'  => 'text',
        // Default value (optional)
        // 'std'   => esc_html__( '', 'citation' ),
        // CLONES: Add to make the field cloneable (i.e. have multiple value)
        'size'  => 50,
        'clone' => false,
      ),
      // TEXT - Series Number
      array(
        // Field name - Will be used as label
        'name'  => esc_html__( 'Series Number', 'citation' ),
        // Field ID, i.e. the meta key
        'id'    => "{$prefix}conference_proceedings_series_number",
        // Field description (optional)
        //'desc'  => esc_html__( 'Special issue: Title of special issue', 'citation' ),
        'type'  => 'text',
        // Default value (optional)
        // 'std'   => esc_html__( '', 'citation' ),
        // CLONES: Add to make the field cloneable (i.e. have multiple value)
        'size'  => 5,
        'clone' => false,
      ),
      // TEXT - ISSN
      array(
        // Field name - Will be used as label
        'name'  => esc_html__( 'Series ISSN', 'citation' ),
        // Label description, display below field name (optional).
        'label_description' => esc_html__( 'Separate print/electronic ISSNs with comma', 'citation' ),
        // Field ID, i.e. the meta key
        'id'    => "{$prefix}conference_proceedings_issn",
        // Field description (optional)
        'desc'  => esc_html__( '1234-5678, 0000-3456', 'citation' ),
        'type'  => 'text',
        // Default value (optional)
        // 'std'   => esc_html__( '', 'citation' ),
        // CLONES: Add to make the field cloneable (i.e. have multiple value)
        'size'  => 20,
        'clone' => false,
      ),

      // HEADING - Conference Session
      array(
        'name'  => esc_html__( 'Conference Session', 'citation' ),
        'desc' => esc_html__( 'Not yet supported by Zotero', 'citation' ),
        'type'  => 'heading',
      ),
      // TEXT - Session Type
      array(
        // Field name - Will be used as label
        'name'  => esc_html__( 'Session Type', 'citation' ),
        // Field description (optional)
        'desc' => esc_html__( 'Paper, poster, symposium, etc.', 'citation' ),
        // Field ID, i.e. the meta key
        'id'    => "{$prefix}genre",
        //'desc'  => esc_html__( 'Smith, John P.', 'citation' ),
        'type'  => 'text',
        // Default value (optional)
        // 'std'   => esc_html__( '', 'citation' ),
        // CLONES: Add to make the field cloneable (i.e. have multiple value)
        'size'  => 10,
        //'clone' => true,
      ),
      // TEXT - Session Title
      array(
        // Field name - Will be used as label
        'name'  => esc_html__( 'Session Title', 'citation' ),
        // Label description, display below field name (optional).
        //'label_description' => esc_html__( 'Title of symposium/session', 'citation' ),
        // Field ID, i.e. the meta key
        'id'    => "{$prefix}session_title",
        // Field description (optional)
        //'desc'  => esc_html__( 'Text description', 'citation' ),
        'type'  => 'text',
        // Default value (optional)
        // 'std'   => esc_html__( '', 'citation' ),
        // CLONES: Add to make the field cloneable (i.e. have multiple value)
        'size'  => 50,
        'clone' => false,
      ),
      // TEXT - Track
      array(
        // Field name - Will be used as label
        'name'  => esc_html__( 'Conference Track Title', 'citation' ),
        // Label description, display below field name (optional).
        //'label_description' => esc_html__( 'Title of conference', 'citation' ),
        // Field ID, i.e. the meta key
        'id'    => "{$prefix}track_title",
        // Field description (optional)
        //'desc'  => esc_html__( 'Special issue: Title of special issue', 'citation' ),
        'type'  => 'text',
        // Default value (optional)
        // 'std'   => esc_html__( '', 'citation' ),
        // CLONES: Add to make the field cloneable (i.e. have multiple value)
        'size'  => 50,
        'clone' => false,
      ),
      // TEXT - Chair
      array(
        // Field name - Will be used as label
        'name'  => esc_html__( 'Chair', 'citation' ),
        // Label description, display below field name (optional).
        'label_description' => esc_html__( 'Enter session chairs in order as: Smith, John P., Jr.', 'citation' ),
        // Field ID, i.e. the meta key
        'id'    => "{$prefix}chair",
        'type'  => 'text',
        // Default value (optional)
        // 'std'   => esc_html__( '', 'citation' ),
        // CLONES: Add to make the field cloneable (i.e. have multiple value)
        'clone' => true,
      ),
    ),
  );

  $meta_boxes[] = array(
    'id'         => 'citation_thesis',
    'title'      => esc_html__( 'Thesis', 'citation' ),
    // Set the post types that citation metaboxes will show on (e.g., post, page, download)
    'post_types' => array( 'post', 'page' ),
    'context'    => 'normal',
    'priority'   => 'high',
    'autosave'   => true,

    // List of meta fields
    'fields'     => array(
      // TEXT - Thesis Type
      array(
        // Field name - Will be used as label
        'name'  => esc_html__( 'Thesis Type', 'citation' ),
        // Label description, display below field name (optional).
        //'label_description' => esc_html__( 'Main title of the item', 'citation' ),
        // Field ID, i.e. the meta key
        'id'    => "{$prefix}dissertation_name",
        // Field description (optional)
        //'desc'  => esc_html__( 'Text description', 'citation' ),
        'type'  => 'text',
        // Default value (optional)
        // 'std'   => esc_html__( '', 'citation' ),
        // CLONES: Add to make the field cloneable (i.e. have multiple value)
        'size'  => 20,
        'clone' => false,
      ),
      // TEXT - Thesis Institution
      array(
        // Field name - Will be used as label
        'name'  => esc_html__( 'University', 'citation' ),
        // Label description, display below field name (optional).
        //'label_description' => esc_html__( 'Separate print and electronic ISSNs with comma', 'citation' ),
        // Field ID, i.e. the meta key
        'id'    => "{$prefix}dissertation_institution",
        // Field description (optional)
        //'desc'  => esc_html__( '1234-5678, 0000-3456', 'citation' ),
        'type'  => 'text',
        // Default value (optional)
        // 'std'   => esc_html__( '', 'citation' ),
        // CLONES: Add to make the field cloneable (i.e. have multiple value)
        'size'  => 30,
        'clone' => false,
      ),
      // TEXT - Thesis Institution Place
      array(
        // Field name - Will be used as label
        'name'  => esc_html__( 'University Location', 'citation' ),
        // Label description, display below field name (optional).
        //'label_description' => esc_html__( 'Separate print and electronic ISSNs with comma', 'citation' ),
        // Field ID, i.e. the meta key
        'id'    => "{$prefix}dissertation_institution_place",
        // Field description (optional)
        //'desc'  => esc_html__( '1234-5678, 0000-3456', 'citation' ),
        'type'  => 'text',
        // Default value (optional)
        // 'std'   => esc_html__( '', 'citation' ),
        // CLONES: Add to make the field cloneable (i.e. have multiple value)
        'size'  => 30,
        'clone' => false,
      ),
      // TEXT - ISBN
      array(
        // Field name - Will be used as label
        'name'  => esc_html__( 'ISBN', 'citation' ),
        // Label description, display below field name (optional).
        //'label_description' => esc_html__( 'Title of book series', 'citation' ),
        // Field ID, i.e. the meta key
        'id'    => "{$prefix}dissertation_isbn",
        // Field description (optional)
        //'desc'  => esc_html__( 'Special issue: Title of special issue', 'citation' ),
        'type'  => 'text',
        // Default value (optional)
        // 'std'   => esc_html__( '', 'citation' ),
        // CLONES: Add to make the field cloneable (i.e. have multiple value)
        'size'  => 20,
        'clone' => false,
      ),
      // TEXT - Advisor
      array(
        // Field name - Will be used as label
        'name'  => esc_html__( 'Advisor/committee', 'citation' ),
        // Label description, display below field name (optional).
        'label_description' => esc_html__( 'Enter advisor and committee as: Smith, John P., Jr.', 'citation' ),
        // Field ID, i.e. the meta key
        'id'    => "{$prefix}contributor",
        'type'  => 'text',
        // Default value (optional)
        // 'std'   => esc_html__( '', 'citation' ),
        // CLONES: Add to make the field cloneable (i.e. have multiple value)
        'clone' => true,
      ),
    ),
  );

  $meta_boxes[] = array(
    'id'         => 'citation_other',
    'title'      => esc_html__( 'Other Metadata', 'citation' ),
    // Set the post types that citation metaboxes will show on (e.g., post, page, download)
    'post_types' => array( 'post', 'page' ),
    'context'    => 'normal',
    'priority'   => 'high',
    'autosave'   => true,

    // List of meta fields
    'fields'     => array(    
      // TEXT - Translator
      array(
        // Field name - Will be used as label
        'name'  => esc_html__( 'Translator', 'citation' ),
        // Label description, display below field name (optional).
        'label_description' => esc_html__( 'Enter translators in order as: Smith, John P., Jr.', 'citation' ),
        // Field ID, i.e. the meta key
        'id'    => "{$prefix}translator",
        // Field description (optional)
        //'desc'  => esc_html__( 'Smith, John P.', 'citation' ),
        'type'  => 'text',
        // Default value (optional)
        // 'std'   => esc_html__( '', 'citation' ),
        // CLONES: Add to make the field cloneable (i.e. have multiple value)
        'clone' => true,
      ),
      // TEXT - Language
      array(
        // Field name - Will be used as label
        'name'  => esc_html__( 'Language', 'citation' ),
        // Label description, display below field name (optional).
        'label_description' => esc_html__( 'Use two letter codes ("en")', 'citation' ),
        // Field ID, i.e. the meta key
        'id'    => "{$prefix}language",
        // Field description (optional)
        'desc'  => esc_html__( 'en', 'citation' ),
        'type'  => 'text',
        // Default value (optional)
        'std'   => esc_html__( 'en', 'citation' ),
        // CLONES: Add to make the field cloneable (i.e. have multiple value)
        'size'  => 5,
        'clone' => false,
      ),
    ),
  );
return $meta_boxes;
}


add_action( 'wp_head', 'write_metadata' );
function write_metadata()
{
    // If this isn't a single post, bail
    if( !is_single() ) return;

    if( !get_post_type() == apply_filters( 'edd_download_metabox_post_types' , array( 'download' ) )) return;
     
    global $post, $wp_query;
    // if $post is empty, get the queired object
    if( empty( $post ) ) $post = $wp_query->get_queried_object();
     
    $values = get_post_custom( $post->ID );
    echo '<meta name="ALL_The_FIELDS" content="' . $values . '" />' . "\n";

    if( isset( $values['citation_title'] ) )
      echo '<meta name="citation_title" content="' . rwmb_meta( 'citation_title' ) . '" />' ."\n";
    if( isset( $values['citation_author'] ) ) {
      $author = rwmb_meta( 'citation_author' );
      foreach ($author as &$value) {
        echo "\t".'<meta name="citation_author" content="' . $value . '" />' ."\n";
      }
      unset($value);
    };
    if( isset( $values['citation_publication_date'] ) )
      echo "\t".'<meta name="citation_publication_date" content="' . rwmb_meta( 'citation_publication_date' ) . '" />' ."\n";
    if( isset( $values['citation_publication_date'] ) )
      echo "\t".'<meta name="citation_date" content="' . rwmb_meta( 'citation_publication_date' ) . '" />' ."\n";
    if( isset( $values['citation_abstract'] ) )
      echo "\t".'<meta name="citation_abstract" content="' . rwmb_meta( 'citation_abstract' ) . '" />' ."\n";
    if( isset( $values['citation_doi'] ) )
      echo "\t".'<meta name="citation_doi" content="' . rwmb_meta( 'citation_doi' ) . '" />' ."\n";
    if( isset( $values['citation_firstpage'] ) )
      echo "\t".'<meta name="citation_firstpage" content="' . rwmb_meta( 'citation_firstpage' ) . '" />' ."\n";
    if( isset( $values['citation_lastpage'] ) )
      echo "\t".'<meta name="citation_lastpage" content="' . rwmb_meta( 'citation_lastpage' ) . '" />' ."\n";


    if( isset( $values['citation_journal_title'] ) )
      echo "\t".'<meta name="citation_journal_title" content="' . rwmb_meta( 'citation_journal_title' ) . '" />' ."\n";
    if( isset( $values['citation_journal_volume'] ) )
      echo "\t".'<meta name="citation_volume" content="' . rwmb_meta( 'citation_journal_volume' ) . '" />' ."\n";
    if( isset( $values['citation_issue'] ) )
      echo "\t".'<meta name="citation_issue" content="' . rwmb_meta( 'citation_issue' ) . '" />' ."\n";
    if( isset( $values['citation_journal_issn'] ) )
      echo "\t".'<meta name="citation_issn" content="' . rwmb_meta( 'citation_journal_issn' ) . '" />' ."\n";
    if( isset( $values['citation_journal_abbreviation'] ) )
      echo "\t".'<meta name="citation_journal_abbreviation" content="' . rwmb_meta( 'citation_journal_abbreviation' ) . '" />' ."\n";
    if( isset( $values['citation_special_issue'] ) )
      echo "\t".'<meta name="citation_series_title" content="' . rwmb_meta( 'citation_special_issue' ) . '" />' ."\n";
       
    if( isset( $values['citation_book_title'] ) )
      echo "\t".'<meta name="citation_book_title" content="' . rwmb_meta( 'citation_book_title' ) . '" />' ."\n";
    if( isset( $values['citation_book_title'] ) )
      echo "\t".'<meta name="citation_inbook_title" content="' . rwmb_meta( 'citation_book_title' ) . '" />' ."\n";
    if( isset( $values['citation_book_volume'] ) )
      echo "\t".'<meta name="citation_volume" content="' . rwmb_meta( 'citation_book_volume' ) . '" />' ."\n";
    if( isset( $values['citation_book_editor'] ) ) {
      $bookeditor = rwmb_meta( 'citation_book_editor' );
      foreach ($bookeditor as &$value) {
        echo "\t".'<meta name="citation_editor" content="' . $value . '" />' ."\n";
      }
      unset($value);
    };
    if( isset( $values['citation_book_publisher'] ) )
      echo "\t".'<meta name="citation_publisher" content="' . rwmb_meta( 'citation_book_publisher' ) . '" />' ."\n";
    if( isset( $values['citation_book_publisher_place'] ) )
      echo "\t".'<meta name="citation_publisher_place" content="' . rwmb_meta( 'citation_book_publisher_place' ) . '" />' ."\n";
    if( isset( $values['citation_book_isbn'] ) )
      echo "\t".'<meta name="citation_isbn" content="' . rwmb_meta( 'citation_book_isbn' ) . '" />' ."\n";
    if( isset( $values['citation_edition'] ) )
      echo "\t".'<meta name="citation_edition" content="' . rwmb_meta( 'citation_edition' ) . '" />' ."\n";
    if( isset( $values['citation_chapter_number'] ) )
      echo "\t".'<meta name="citation_chapter_number" content="' . rwmb_meta( 'citation_chapter_number' ) . '" />' ."\n";     
    if( isset( $values['citation_book_series_title'] ) )
      echo "\t".'<meta name="citation_series_title" content="' . rwmb_meta( 'citation_book_series_title' ) . '" />' ."\n";
    if( isset( $values['citation_book_series_number'] ) )
      echo "\t".'<meta name="citation_number" content="' . rwmb_meta( 'citation_book_series_number' ) . '" />' ."\n";
    if( isset( $values['citation_book_issn'] ) )
      echo "\t".'<meta name="citation_issn" content="' . rwmb_meta( 'citation_book_issn' ) . '" />' ."\n";


    if( isset( $values['citation_technical_report_name'] ) )
      echo "\t".'<meta name="citation_technical_report_name" content="' . rwmb_meta( 'citation_technical_report_name' ) . '" />' ."\n";
    if( isset( $values['citation_technical_report_number'] ) )
      echo "\t".'<meta name="citation_technical_report_number" content="' . rwmb_meta( 'citation_technical_report_number' ) . '" />' ."\n";
    if( isset( $values['citation_technical_report_institution'] ) )
      echo "\t".'<meta name="citation_technical_report_institution" content="' . rwmb_meta( 'citation_technical_report_institution' ) . '" />' ."\n";
    if( isset( $values['citation_technical_report_institution_place'] ) )
      echo "\t".'<meta name="citation_technical_report_institution_place" content="' . rwmb_meta( 'citation_technical_report_institution_place' ) . '" />' ."\n";
    if( isset( $values['citation_technical_report_institution_place'] ) )
      echo "\t".'<meta name="citation_publisher_place" content="' . rwmb_meta( 'citation_technical_report_institution_place' ) . '" />' ."\n";
    if( isset( $values['citation_report_isbn'] ) )
      echo "\t".'<meta name="citation_isbn" content="' . rwmb_meta( 'citation_report_isbn' ) . '" />' ."\n";
    if( isset( $values['citation_parent_report_title'] ) )
      echo "\t".'<meta name="citation_book_title" content="' . rwmb_meta( 'citation_parent_report_title' ) . '" />' ."\n";
    if( isset( $values['citation_parent_report_title'] ) )
      echo "\t".'<meta name="citation_inbook_title" content="' . rwmb_meta( 'citation_parent_report_title' ) . '" />' ."\n";
    if( isset( $values['citation_report_editor'] ) ) {
      $reporteditor = rwmb_meta( 'citation_report_editor' );
      foreach ($reporteditor as &$value) {
        echo "\t".'<meta name="citation_editor" content="' . $value . '" />' ."\n";
      }
      unset($value);
    };
    if( isset( $values['citation_report_series_title'] ) )
      echo "\t".'<meta name="citation_series_title" content="' . rwmb_meta( 'citation_report_series_title' ) . '" />' ."\n";
    if( isset( $values['citation_report_series_number'] ) )
      echo "\t".'<meta name="citation_number" content="' . rwmb_meta( 'citation_report_series_number' ) . '" />' ."\n";
    if( isset( $values['citation_report_issn'] ) )
      echo "\t".'<meta name="citation_issn" content="' . rwmb_meta( 'citation_report_issn' ) . '" />' ."\n";

    if( isset( $values['citation_conference_title'] ) )
      echo "\t".'<meta name="citation_conference_title" content="' . rwmb_meta( 'citation_conference_title' ) . '" />' ."\n";
    if( isset( $values['citation_conference_title'] ) )
      echo "\t".'<meta name="citation_conference" content="' . rwmb_meta( 'citation_conference_title' ) . '" />' ."\n";
    if( isset( $values['citation_conference_place'] ) )
      echo "\t".'<meta name="citation_conference_place" content="' . rwmb_meta( 'citation_conference_place' ) . '" />' ."\n";
    if( isset( $values['citation_conference_date'] ) )
      echo "\t".'<meta name="citation_conference_date" content="' . rwmb_meta( 'citation_conference_date' ) . '" />' ."\n";

    if( isset( $values['citation_conference_proceedings_title'] ) )
      echo "\t".'<meta name="citation_book_title" content="' . rwmb_meta( 'citation_conference_proceedings_title' ) . '" />' ."\n";
    if( isset( $values['citation_conference_proceedings_title'] ) )
      echo "\t".'<meta name="citation_inbook_title" content="' . rwmb_meta( 'citation_conference_proceedings_title' ) . '" />' ."\n";
    if( isset( $values['citation_conference_proceedings_title'] ) )
      echo "\t".'<meta name="citation_conference_proceedings_title" content="' . rwmb_meta( 'citation_conference_proceedings_title' ) . '" />' ."\n";
    if( isset( $values['citation_conference_proceedings_volume'] ) )
      echo "\t".'<meta name="citation_volume" content="' . rwmb_meta( 'citation_conference_proceedings_volume' ) . '" />' ."\n";
    if( isset( $values['citation_conference_proceedings_editor'] ) ) {
      $proceedingseditor = rwmb_meta( 'citation_conference_proceedings_editor' );
      foreach ($proceedingseditor as &$value) {
        echo "\t".'<meta name="citation_editor" content="' . $value . '" />' ."\n";
      }
      unset($value);
    };
    if( isset( $values['citation_conference_proceedings_publisher'] ) )
      echo "\t".'<meta name="citation_publisher" content="' . rwmb_meta( 'citation_conference_proceedings_publisher' ) . '" />' ."\n";
    if( isset( $values['citation_conference_proceedings_publisher_place'] ) )
      echo "\t".'<meta name="citation_conference_proceedings_place" content="' . rwmb_meta( 'citation_book_publisher_place' ) . '" />' ."\n";
    if( isset( $values['citation_conference_proceedings_isbn'] ) )
      echo "\t".'<meta name="citation_isbn" content="' . rwmb_meta( 'citation_conference_proceedings_isbn' ) . '" />' ."\n";
    if( isset( $values['citation_conference_proceedings_series_title'] ) )
      echo "\t".'<meta name="citation_series_title" content="' . rwmb_meta( 'citation_conference_proceedings_series_title' ) . '" />' ."\n";
    if( isset( $values['citation_conference_proceedings_series_number'] ) )
      echo "\t".'<meta name="citation_number" content="' . rwmb_meta( 'citation_conference_proceedings_series_number' ) . '" />' ."\n";
    if( isset( $values['citation_conference_proceedings_issn'] ) )
      echo "\t".'<meta name="citation_issn" content="' . rwmb_meta( 'citation_conference_proceedings_issn' ) . '" />' ."\n";

    if( isset( $values['citation_genre'] ) )
      echo "\t".'<meta name="citation_genre" content="' . rwmb_meta( 'citation_genre' ) . '" />' ."\n";
    if( isset( $values['citation_session_title'] ) )
      echo "\t".'<meta name="citation_session_title" content="' . rwmb_meta( 'citation_session_title' ) . '" />' ."\n";
    if( isset( $values['citation_track_title'] ) )
      echo "\t".'<meta name="citation_track_title" content="' . rwmb_meta( 'citation_track_title' ) . '" />' ."\n";
    if( isset( $values['citation_chair'] ) ) {
      $chair = rwmb_meta( 'citation_chair' );
      foreach ($chair as &$value) {
        echo "\t".'<meta name="citation_chair" content="' . $value . '" />' ."\n";
      }
      unset($value);
    };

    if( isset( $values['citation_dissertation_name'] ) )
      echo "\t".'<meta name="citation_dissertation_name" content="' . rwmb_meta( 'citation_dissertation_name' ) . '" />' ."\n";
    if( isset( $values['citation_dissertation_institution'] ) )
      echo "\t".'<meta name="citation_dissertation_institution" content="' . rwmb_meta( 'citation_dissertation_institution' ) . '" />' ."\n";
    if( isset( $values['citation_dissertation_institution_place'] ) )
      echo "\t".'<meta name="citation_dissertation_institution_place" content="' . rwmb_meta( 'citation_dissertation_institution_place' ) . '" />' ."\n";
    if( isset( $values['citation_dissertation_isbn'] ) )
      echo "\t".'<meta name="citation_isbn" content="' . rwmb_meta( 'citation_dissertation_isbn' ) . '" />' ."\n";
    if( isset( $values['citation_contributor'] ) ) {
      $contributor = rwmb_meta( 'citation_contributor' );
      foreach ($contributor as &$value) {
        echo "\t".'<meta name="citation_contributor" content="' . $value . '" />' ."\n";
      }
      unset($value);
    };

    if( isset( $values['citation_translator'] ) ) {
      $author = rwmb_meta( 'citation_translator' );
      foreach ($author as &$value) {
        echo "\t".'<meta name="citation_translator" content="' . $value . '" />' ."\n";
      }
      unset($value);
    };
    if( isset( $values['citation_language'] ) )
      echo "\t".'<meta name="citation_language" content="' . rwmb_meta( 'citation_language' ) . '" />' ."\n";

    if( isset( $values['citation_pdf_url'] ) )
      echo "\t".'<meta name="citation_pdf_url" content="' . esc_url( rwmb_meta( 'citation_pdf_url' ) ) . '" />' ."\n"; 
    echo "\t".'<meta name="citation_abstract_html_url" content="' . esc_url(  get_permalink() ) . '" />' ."\n";
  }
?>
