<?php
/**
 * Plugin installation and activation for WordPress themes.
 *
 * Please note that this is a drop-in library for a theme or plugin.
 * The authors of this library (Thomas, Gary and Juliette) are NOT responsible
 * for the support of your plugin or theme. Please contact the plugin
 * or theme author for support.
 *
 * @package   TGM-Plugin-Activation
 * @version   2.6.1 for parent theme Clubio for publication on ThemeForest
 * @link      http://tgmpluginactivation.com/
 * @author    Thomas Griffin, Gary Jones, Juliette Reinders Folmer
 * @copyright Copyright (c) 2011, Thomas Griffin
 * @license   GPL-2.0+
 */

/*
	Copyright 2011 Thomas Griffin (thomasgriffinmedia.com)

	This program is free software; you can redistribute it and/or modify
	it under the terms of the GNU General Public License, version 2, as
	published by the Free Software Foundation.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program; if not, write to the Free Software
	Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

if ( ! class_exists( 'TGM_Plugin_Activation' ) ) {
	class TGM_Plugin_Activation {
		const TGMPA_VERSION = '2.6.1';
		const WP_REPO_REGEX = '|^http[s]?://wordpress\.org/(?:extend/)?plugins/|';
		const IS_URL_REGEX = '|^http[s]?://|';
		public static $instance;
		public $plugins = array();
		protected $sort_order = array();
		protected $has_forced_activation = false;
		protected $has_forced_deactivation = false;
		public $id = 'tgmpa';
		protected $menu = 'tgmpa-install-plugins';
		public $parent_slug = 'themes.php';
		public $capability = 'edit_theme_options';
		public $default_path = '';
		public $has_notices = true;
		public $dismissable = true;
		public $dismiss_msg = '';
		public $is_automatic = false;
		public $message = '';
		public $strings = array();
		public $wp_version;
		public $page_hook;
		public function __construct() {
			$this->wp_version = $GLOBALS['wp_version'];
			do_action_ref_array( 'tgmpa_init', array( $this ) );
			add_action( 'init', array( $this, 'init' ) );
		}
		public function __set( $name, $value ) {
			return;
		}

		public function __get( $name ) {
			return $this->{$name};
		}
		public function init() {
			if ( true !== apply_filters( 'tgmpa_load', ( is_admin() && ! defined( 'DOING_AJAX' ) ) ) ) {
				return;
			}
			$this->strings = array(
				'page_title'                      => esc_html__( 'Install Required Plugins', 'clubio' ),
				'menu_title'                      => esc_html__( 'Install Plugins', 'clubio' ),
				'installing'                      => esc_html__( 'Installing Plugin: %s', 'clubio' ),
				'updating'                        => esc_html__( 'Updating Plugin: %s', 'clubio' ),
				'oops'                            => esc_html__( 'Something went wrong with the plugin API.', 'clubio' ),
				'notice_can_install_required'     => _n_noop(
					'This theme requires the following plugin: %1$s.',
					'This theme requires the following plugins: %1$s.',
					'clubio'
				),
				'notice_can_install_recommended'  => _n_noop(
					'This theme recommends the following plugin: %1$s.',
					'This theme recommends the following plugins: %1$s.',
					'clubio'
				),
				'notice_ask_to_update'            => _n_noop(
					'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.',
					'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.',
					'clubio'
				),
				'notice_ask_to_update_maybe'      => _n_noop(
					'There is an update available for: %1$s.',
					'There are updates available for the following plugins: %1$s.',
					'clubio'
				),
				'notice_can_activate_required'    => _n_noop(
					'The following required plugin is currently inactive: %1$s.',
					'The following required plugins are currently inactive: %1$s.',
					'clubio'
				),
				'notice_can_activate_recommended' => _n_noop(
					'The following recommended plugin is currently inactive: %1$s.',
					'The following recommended plugins are currently inactive: %1$s.',
					'clubio'
				),
				'install_link'                    => _n_noop(
					'Begin installing plugin',
					'Begin installing plugins',
					'clubio'
				),
				'update_link'                     => _n_noop(
					'Begin updating plugin',
					'Begin updating plugins',
					'clubio'
				),
				'activate_link'                   => _n_noop(
					'Begin activating plugin',
					'Begin activating plugins',
					'clubio'
				),
				'return'                          => esc_html__( 'Return to Required Plugins Installer', 'clubio' ),
				'dashboard'                       => esc_html__( 'Return to the Dashboard', 'clubio' ),
				'plugin_activated'                => esc_html__( 'Plugin activated successfully.', 'clubio' ),
				'activated_successfully'          => esc_html__( 'The following plugin was activated successfully:', 'clubio' ),
				'plugin_already_active'           => esc_html__( 'No action taken. Plugin %1$s was already active.', 'clubio' ),
				'plugin_needs_higher_version'     => esc_html__( 'Plugin not activated. A higher version of %s is needed for this theme. Please update the plugin.', 'clubio' ),
				'complete'                        => esc_html__( 'All plugins installed and activated successfully. %1$s', 'clubio' ),
				'dismiss'                         => esc_html__( 'Dismiss this notice', 'clubio' ),
				'notice_cannot_install_activate'  => esc_html__( 'There are one or more required or recommended plugins to install, update or activate.', 'clubio' ),
				'contact_admin'                   => esc_html__( 'Please contact the administrator of this site for help.', 'clubio' ),
			);

			do_action( 'tgmpa_register' );
			if ( empty( $this->plugins ) || ! is_array( $this->plugins ) ) {
				return;
			}

			if ( true !== $this->is_tgmpa_complete() ) {
				array_multisort( $this->sort_order, SORT_ASC, $this->plugins );

				add_action( 'admin_menu', array( $this, 'admin_menu' ) );
				add_action( 'admin_head', array( $this, 'dismiss' ) );

				add_filter( 'install_plugin_complete_actions', array( $this, 'actions' ) );
				add_filter( 'update_plugin_complete_actions', array( $this, 'actions' ) );

				if ( $this->has_notices ) {
					add_action( 'admin_notices', array( $this, 'notices' ) );
					add_action( 'admin_init', array( $this, 'admin_init' ), 1 );
					add_action( 'admin_enqueue_scripts', array( $this, 'thickbox' ) );
				}
			}

			add_action( 'load-plugins.php', array( $this, 'add_plugin_action_link_filters' ), 1 );

			add_action( 'switch_theme', array( $this, 'flush_plugins_cache' ) );

			if ( $this->has_notices ) {
				add_action( 'switch_theme', array( $this, 'update_dismiss' ) );
			}

			if ( true === $this->has_forced_activation ) {
				add_action( 'admin_init', array( $this, 'force_activation' ) );
			}

			if ( true === $this->has_forced_deactivation ) {
				add_action( 'switch_theme', array( $this, 'force_deactivation' ) );
			}
		}
		public function correct_plugin_mofile( $mofile, $domain ) {
			if ( 'tgmpa' !== $domain ) {
				return $mofile;
			}
			return preg_replace( '`/([a-z]{2}_[A-Z]{2}.mo)$`', '/tgmpa-$1', $mofile );
		}

		public function add_plugin_action_link_filters() {
			foreach ( $this->plugins as $slug => $plugin ) {
				if ( false === $this->can_plugin_activate( $slug ) ) {
					add_filter( 'plugin_action_links_' . $plugin['file_path'], array( $this, 'filter_plugin_action_links_activate' ), 20 );
				}

				if ( true === $plugin['force_activation'] ) {
					add_filter( 'plugin_action_links_' . $plugin['file_path'], array( $this, 'filter_plugin_action_links_deactivate' ), 20 );
				}

				if ( false !== $this->does_plugin_require_update( $slug ) ) {
					add_filter( 'plugin_action_links_' . $plugin['file_path'], array( $this, 'filter_plugin_action_links_update' ), 20 );
				}
			}
		}

		public function filter_plugin_action_links_activate( $actions ) {
			unset( $actions['activate'] );

			return $actions;
		}

		public function filter_plugin_action_links_deactivate( $actions ) {
			unset( $actions['deactivate'] );

			return $actions;
		}

		public function filter_plugin_action_links_update( $actions ) {
			$actions['update'] = sprintf(
				'<a href="%1$s" title="%2$s" class="edit">%3$s</a>',
				esc_url( $this->get_tgmpa_status_url( 'update' ) ),
                esc_html__( 'This plugin needs to be updated to be compatible with your theme.', 'clubio' ),
                esc_html__( 'Update Required', 'clubio' )
			);

			return $actions;
		}

		public function admin_init() {
			if ( ! $this->is_tgmpa_page() ) {
				return;
			}

			if ( isset( $_REQUEST['tab'] ) && 'plugin-information' === $_REQUEST['tab'] ) {
				require_once ABSPATH . 'wp-admin/includes/plugin-install.php';

				wp_enqueue_style( 'plugin-install' );

				global $tab, $body_id;
				$body_id = 'plugin-information';
				$tab     = 'plugin-information';

				install_plugin_information();

				exit;
			}
		}
		public function thickbox() {
			if ( ! get_user_meta( get_current_user_id(), 'tgmpa_dismissed_notice_' . $this->id, true ) ) {
				add_thickbox();
			}
		}

		public function admin_menu() {
			if ( ! current_user_can( 'install_plugins' ) ) {
				return;
			}

			$args = apply_filters(
				'tgmpa_admin_menu_args',
				array(
					'parent_slug' => $this->parent_slug,
					'page_title'  => $this->strings['page_title'],
					'menu_title'  => $this->strings['menu_title'],
					'capability'  => $this->capability,
					'menu_slug'   => $this->menu,
					'function'    => array( $this, 'install_plugins_page' ),
				)
			);

			$this->add_admin_menu( $args );
		}

		protected function add_admin_menu( array $args ) {
			$this->page_hook = add_theme_page( $args['page_title'], $args['menu_title'], $args['capability'], $args['menu_slug'], $args['function'] );
		}

		public function install_plugins_page() {
			$plugin_table = new TGMPA_List_Table;

			if ( ( ( 'tgmpa-bulk-install' === $plugin_table->current_action() || 'tgmpa-bulk-update' === $plugin_table->current_action() ) && $plugin_table->process_bulk_actions() ) || $this->do_plugin_install() ) {
				return;
			}

			wp_clean_plugins_cache( false );

			?>
			<div class="tgmpa wrap">
				<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
				<?php $plugin_table->prepare_items(); ?>

				<?php
				if ( ! empty( $this->message ) && is_string( $this->message ) ) {
					echo wp_kses_post( $this->message );
				}
				?>
				<?php $plugin_table->views(); ?>

				<form id="tgmpa-plugins" action="" method="post">
					<input type="hidden" name="tgmpa-page" value="<?php echo esc_attr( $this->menu ); ?>" />
					<input type="hidden" name="plugin_status" value="<?php echo esc_attr( $plugin_table->view_context ); ?>" />
					<?php $plugin_table->display(); ?>
				</form>
			</div>
			<?php
		}

		protected function do_plugin_install() {
			if ( empty( $_GET['plugin'] ) ) {
				return false;
			}

			$slug = $this->sanitize_key( urldecode( $_GET['plugin'] ) );

			if ( ! isset( $this->plugins[ $slug ] ) ) {
				return false;
			}

			if ( ( isset( $_GET['tgmpa-install'] ) && 'install-plugin' === $_GET['tgmpa-install'] ) || ( isset( $_GET['tgmpa-update'] ) && 'update-plugin' === $_GET['tgmpa-update'] ) ) {

				$install_type = 'install';
				if ( isset( $_GET['tgmpa-update'] ) && 'update-plugin' === $_GET['tgmpa-update'] ) {
					$install_type = 'update';
				}

				check_admin_referer( 'tgmpa-' . $install_type, 'tgmpa-nonce' );

				$url = wp_nonce_url(
					add_query_arg(
						array(
							'plugin'                 => urlencode( $slug ),
							'tgmpa-' . $install_type => $install_type . '-plugin',
						),
						$this->get_tgmpa_url()
					),
					'tgmpa-' . $install_type,
					'tgmpa-nonce'
				);

				$method = '';

				if ( false === ( $creds = request_filesystem_credentials( esc_url_raw( $url ), $method, false, false, array() ) ) ) {
					return true;
				}

				if ( ! WP_Filesystem( $creds ) ) {
					request_filesystem_credentials( esc_url_raw( $url ), $method, true, false, array() );
					return true;
				}

				$extra         = array();
				$extra['slug'] = $slug;
				$source        = $this->get_download_url( $slug );
				$api           = ( 'repo' === $this->plugins[ $slug ]['source_type'] ) ? $this->get_plugins_api( $slug ) : null;
				$api           = ( false !== $api ) ? $api : null;

				$url = add_query_arg(
					array(
						'action' => $install_type . '-plugin',
						'plugin' => urlencode( $slug ),
					),
					'update.php'
				);

				if ( ! class_exists( 'Plugin_Upgrader', false ) ) {
					require_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
				}

				$title     = ( 'update' === $install_type ) ? $this->strings['updating'] : $this->strings['installing'];
				$skin_args = array(
					'type'   => ( 'bundled' !== $this->plugins[ $slug ]['source_type'] ) ? 'web' : 'upload',
					'title'  => sprintf( $title, $this->plugins[ $slug ]['name'] ),
					'url'    => esc_url_raw( $url ),
					'nonce'  => $install_type . '-plugin_' . $slug,
					'plugin' => '',
					'api'    => $api,
					'extra'  => $extra,
				);
				unset( $title );

				if ( 'update' === $install_type ) {
					$skin_args['plugin'] = $this->plugins[ $slug ]['file_path'];
					$skin                = new Plugin_Upgrader_Skin( $skin_args );
				} else {
					$skin = new Plugin_Installer_Skin( $skin_args );
				}

				$upgrader = new Plugin_Upgrader( $skin );

				add_filter( 'upgrader_source_selection', array( $this, 'maybe_adjust_source_dir' ), 1, 3 );

				if ( 'update' === $install_type ) {
					$to_inject                    = array( $slug => $this->plugins[ $slug ] );
					$to_inject[ $slug ]['source'] = $source;
					$this->inject_update_info( $to_inject );

					$upgrader->upgrade( $this->plugins[ $slug ]['file_path'] );
				} else {
					$upgrader->install( $source );
				}

				remove_filter( 'upgrader_source_selection', array( $this, 'maybe_adjust_source_dir' ), 1 );

				$this->populate_file_path( $slug );

				if ( $this->is_automatic && ! $this->is_plugin_active( $slug ) ) {
					$plugin_activate = $upgrader->plugin_info();
					if ( false === $this->activate_single_plugin( $plugin_activate, $slug, true ) ) {
						return true;
					}
				}

				$this->show_tgmpa_version();

				if ( $this->is_tgmpa_complete() ) {
					echo '<p>', sprintf( esc_html( $this->strings['complete'] ), '<a href="' . esc_url( self_admin_url() ) . '">' . esc_html__( 'Return to the Dashboard', 'clubio' ) . '</a>' ), '</p>';
					echo '<style type="text/css">#adminmenu .wp-submenu li.current { display: none !important; }</style>';
				} else {
					echo '<p><a href="', esc_url( $this->get_tgmpa_url() ), '" target="_parent">', esc_html( $this->strings['return'] ), '</a></p>';
				}

				return true;
			} elseif ( isset( $this->plugins[ $slug ]['file_path'], $_GET['tgmpa-activate'] ) && 'activate-plugin' === $_GET['tgmpa-activate'] ) {
				check_admin_referer( 'tgmpa-activate', 'tgmpa-nonce' );

				if ( false === $this->activate_single_plugin( $this->plugins[ $slug ]['file_path'], $slug ) ) {
					return true;
				}
			}

			return false;
		}

		public function inject_update_info( $plugins ) {
			$repo_updates = get_site_transient( 'update_plugins' );

			if ( ! is_object( $repo_updates ) ) {
				$repo_updates = new stdClass;
			}

			foreach ( $plugins as $slug => $plugin ) {
				$file_path = $plugin['file_path'];

				if ( empty( $repo_updates->response[ $file_path ] ) ) {
					$repo_updates->response[ $file_path ] = new stdClass;
				}

				$repo_updates->response[ $file_path ]->slug        = $slug;
				$repo_updates->response[ $file_path ]->plugin      = $file_path;
				$repo_updates->response[ $file_path ]->new_version = $plugin['version'];
				$repo_updates->response[ $file_path ]->package     = $plugin['source'];
				if ( empty( $repo_updates->response[ $file_path ]->url ) && ! empty( $plugin['external_url'] ) ) {
					$repo_updates->response[ $file_path ]->url = $plugin['external_url'];
				}
			}

			set_site_transient( 'update_plugins', $repo_updates );
		}

		public function maybe_adjust_source_dir( $source, $remote_source, $upgrader ) {
			if ( ! $this->is_tgmpa_page() || ! is_object( $GLOBALS['wp_filesystem'] ) ) {
				return $source;
			}

			$source_files = array_keys( $GLOBALS['wp_filesystem']->dirlist( $remote_source ) );
			if ( 1 === count( $source_files ) && false === $GLOBALS['wp_filesystem']->is_dir( $source ) ) {
				return $source;
			}
			$desired_slug = '';
			if ( false === $upgrader->bulk && ! empty( $upgrader->skin->options['extra']['slug'] ) ) {
				$desired_slug = $upgrader->skin->options['extra']['slug'];
			} else {
				foreach ( $this->plugins as $slug => $plugin ) {
					if ( ! empty( $upgrader->skin->plugin_names[ $upgrader->skin->i ] ) && $plugin['name'] === $upgrader->skin->plugin_names[ $upgrader->skin->i ] ) {
						$desired_slug = $slug;
						break;
					}
				}
				unset( $slug, $plugin );
			}

			if ( ! empty( $desired_slug ) ) {
				$subdir_name = untrailingslashit( str_replace( trailingslashit( $remote_source ), '', $source ) );

				if ( ! empty( $subdir_name ) && $subdir_name !== $desired_slug ) {
					$from_path = untrailingslashit( $source );
					$to_path   = trailingslashit( $remote_source ) . $desired_slug;

					if ( true === $GLOBALS['wp_filesystem']->move( $from_path, $to_path ) ) {
						return trailingslashit( $to_path );
					} else {
						return new WP_Error( 'rename_failed', esc_html__( 'The remote plugin package does not contain a folder with the desired slug and renaming did not work.', 'clubio' ) . ' ' . esc_html__( 'Please contact the plugin provider and ask them to package their plugin according to the WordPress guidelines.', 'clubio' ), array( 'found' => $subdir_name, 'expected' => $desired_slug ) );
					}
				} elseif ( empty( $subdir_name ) ) {
					return new WP_Error( 'packaged_wrong', esc_html__( 'The remote plugin package consists of more than one file, but the files are not packaged in a folder.', 'clubio' ) . ' ' . esc_html__( 'Please contact the plugin provider and ask them to package their plugin according to the WordPress guidelines.', 'clubio' ), array( 'found' => $subdir_name, 'expected' => $desired_slug ) );
				}
			}

			return $source;
		}
		protected function activate_single_plugin( $file_path, $slug, $automatic = false ) {
			if ( $this->can_plugin_activate( $slug ) ) {
				$activate = activate_plugin( $file_path );

				if ( is_wp_error( $activate ) ) {
					echo '<div id="message" class="error"><p>', wp_kses_post( $activate->get_error_message() ), '</p></div>',
						'<p><a href="', esc_url( $this->get_tgmpa_url() ), '" target="_parent">', esc_html( $this->strings['return'] ), '</a></p>';

					return false;
				} else {
					if ( ! $automatic ) {
						if ( ! isset( $_POST['action'] ) ) {
							echo '<div id="message" class="updated"><p>', esc_html( $this->strings['activated_successfully'] ), ' <strong>', esc_attr( $this->plugins[ $slug ]['name'] ), '.</strong></p></div>';
						}
					} else {
						echo '<p>', esc_attr( $this->strings['plugin_activated'] ), '</p>';
					}
				}
			} elseif ( $this->is_plugin_active( $slug ) ) {
				echo '<div id="message" class="error"><p>',
					sprintf(
                        esc_attr( $this->strings['plugin_already_active'] ),
						'<strong>' . esc_attr( $this->plugins[ $slug ]['name'] ) . '</strong>'
					),
					'</p></div>';
			} elseif ( $this->does_plugin_require_update( $slug ) ) {
				if ( ! $automatic ) {
					if ( ! isset( $_POST['action'] ) ) {
						echo '<div id="message" class="error"><p>',
							sprintf(
                                esc_attr( $this->strings['plugin_needs_higher_version'] ),
								'<strong>' . esc_attr( $this->plugins[ $slug ]['name'] ) . '</strong>'
							),
							'</p></div>';
					}
				} else {
					echo '<p>', sprintf( esc_attr( $this->strings['plugin_needs_higher_version'] ), esc_attr( $this->plugins[ $slug ]['name'] ) ), '</p>';
				}
			}

			return true;
		}

		public function notices() {
			if ( ( $this->is_tgmpa_page() || $this->is_core_update_page() ) || get_user_meta( get_current_user_id(), 'tgmpa_dismissed_notice_' . $this->id, true ) || ! current_user_can( apply_filters( 'tgmpa_show_admin_notice_capability', 'publish_posts' ) ) ) {
				return;
			}

			$message = array();

			$install_link_count          = 0;
			$update_link_count           = 0;
			$activate_link_count         = 0;
			$total_required_action_count = 0;

			foreach ( $this->plugins as $slug => $plugin ) {
				if ( $this->is_plugin_active( $slug ) && false === $this->does_plugin_have_update( $slug ) ) {
					continue;
				}

				if ( ! $this->is_plugin_installed( $slug ) ) {
					if ( current_user_can( 'install_plugins' ) ) {
						$install_link_count++;

						if ( true === $plugin['required'] ) {
							$message['notice_can_install_required'][] = $slug;
						} else {
							$message['notice_can_install_recommended'][] = $slug;
						}
					}
					if ( true === $plugin['required'] ) {
						$total_required_action_count++;
					}
				} else {
					if ( ! $this->is_plugin_active( $slug ) && $this->can_plugin_activate( $slug ) ) {
						if ( current_user_can( 'activate_plugins' ) ) {
							$activate_link_count++;

							if ( true === $plugin['required'] ) {
								$message['notice_can_activate_required'][] = $slug;
							} else {
								$message['notice_can_activate_recommended'][] = $slug;
							}
						}
						if ( true === $plugin['required'] ) {
							$total_required_action_count++;
						}
					}

					if ( $this->does_plugin_require_update( $slug ) || false !== $this->does_plugin_have_update( $slug ) ) {

						if ( current_user_can( 'update_plugins' ) ) {
							$update_link_count++;

							if ( $this->does_plugin_require_update( $slug ) ) {
								$message['notice_ask_to_update'][] = $slug;
							} elseif ( false !== $this->does_plugin_have_update( $slug ) ) {
								$message['notice_ask_to_update_maybe'][] = $slug;
							}
						}
						if ( true === $plugin['required'] ) {
							$total_required_action_count++;
						}
					}
				}
			}
			unset( $slug, $plugin );

			if ( ! empty( $message ) || $total_required_action_count > 0 ) {
				krsort( $message );
				$rendered = '';

				$line_template = '<span style="display: block; margin: 0.5em 0.5em 0 0; clear: both;">%s</span>' . "\n";

				if ( ! current_user_can( 'activate_plugins' ) && ! current_user_can( 'install_plugins' ) && ! current_user_can( 'update_plugins' ) ) {
					$rendered  = esc_attr( $this->strings['notice_cannot_install_activate'] ) . ' ' . esc_attr( $this->strings['contact_admin'] );
					$rendered .= $this->create_user_action_links_for_notice( 0, 0, 0, $line_template );
				} else {

					if ( ! $this->dismissable && ! empty( $this->dismiss_msg ) ) {
						$rendered .= sprintf( $line_template, wp_kses_post( $this->dismiss_msg ) );
					}

					foreach ( $message as $type => $plugin_group ) {
						$linked_plugins = array();

						foreach ( $plugin_group as $plugin_slug ) {
							$linked_plugins[] = $this->get_info_link( $plugin_slug );
						}
						unset( $plugin_slug );

						$count          = count( $plugin_group );
						$linked_plugins = array_map( array( 'TGMPA_Utils', 'wrap_in_em' ), $linked_plugins );
						$last_plugin    = array_pop( $linked_plugins );
						$imploded       = empty( $linked_plugins ) ? $last_plugin : ( implode( ', ', $linked_plugins ) . ' ' . esc_html_x( 'and', 'plugin A *and* plugin B', 'clubio' ) . ' ' . $last_plugin );

						$rendered .= sprintf(
							$line_template,
							sprintf(
								translate_nooped_plural( $this->strings[ $type ], $count, 'clubio' ),
								$imploded,
								$count
							)
						);

					}
					unset( $type, $plugin_group, $linked_plugins, $count, $last_plugin, $imploded );

					$rendered .= $this->create_user_action_links_for_notice( $install_link_count, $update_link_count, $activate_link_count, $line_template );
				}

				add_settings_error( 'tgmpa', 'tgmpa', $rendered, $this->get_admin_notice_class() );
			}

			if ( 'options-general' !== $GLOBALS['current_screen']->parent_base ) {
				$this->display_settings_errors();
			}
		}
		protected function create_user_action_links_for_notice( $install_count, $update_count, $activate_count, $line_template ) {
			$action_links = array(
				'install'  => '',
				'update'   => '',
				'activate' => '',
				'dismiss'  => $this->dismissable ? '<a href="' . esc_url( wp_nonce_url( add_query_arg( 'tgmpa-dismiss', 'dismiss_admin_notices' ), 'tgmpa-dismiss-' . get_current_user_id() ) ) . '" class="dismiss-notice" target="_parent">' . esc_html( $this->strings['dismiss'] ) . '</a>' : '',
			);

			$link_template = '<a href="%2$s">%1$s</a>';

			if ( current_user_can( 'install_plugins' ) ) {
				if ( $install_count > 0 ) {
					$action_links['install'] = sprintf(
						$link_template,
						translate_nooped_plural( $this->strings['install_link'], $install_count, 'clubio' ),
						esc_url( $this->get_tgmpa_status_url( 'install' ) )
					);
				}
				if ( $update_count > 0 ) {
					$action_links['update'] = sprintf(
						$link_template,
						translate_nooped_plural( $this->strings['update_link'], $update_count, 'clubio' ),
						esc_url( $this->get_tgmpa_status_url( 'update' ) )
					);
				}
			}

			if ( current_user_can( 'activate_plugins' ) && $activate_count > 0 ) {
				$action_links['activate'] = sprintf(
					$link_template,
					translate_nooped_plural( $this->strings['activate_link'], $activate_count, 'clubio' ),
					esc_url( $this->get_tgmpa_status_url( 'activate' ) )
				);
			}

			$action_links = apply_filters( 'tgmpa_notice_action_links', $action_links );

			$action_links = array_filter( (array) $action_links );

			if ( ! empty( $action_links ) ) {
				$action_links = sprintf( $line_template, implode( ' | ', $action_links ) );
				return apply_filters( 'tgmpa_notice_rendered_action_links', $action_links );
			} else {
				return '';
			}
		}

		protected function get_admin_notice_class() {
			if ( ! empty( $this->strings['nag_type'] ) ) {
				return sanitize_html_class( strtolower( $this->strings['nag_type'] ) );
			} else {
				if ( version_compare( $this->wp_version, '4.2', '>=' ) ) {
					return 'notice-warning';
				} elseif ( version_compare( $this->wp_version, '4.1', '>=' ) ) {
					return 'notice';
				} else {
					return 'updated';
				}
			}
		}

		protected function display_settings_errors() {
			global $wp_settings_errors;

			settings_errors( 'tgmpa' );

			foreach ( (array) $wp_settings_errors as $key => $details ) {
				if ( 'tgmpa' === $details['setting'] ) {
					unset( $wp_settings_errors[ $key ] );
					break;
				}
			}
		}

		public function dismiss() {
			if ( isset( $_GET['tgmpa-dismiss'] ) && check_admin_referer( 'tgmpa-dismiss-' . get_current_user_id() ) ) {
				update_user_meta( get_current_user_id(), 'tgmpa_dismissed_notice_' . $this->id, 1 );
			}
		}

		public function register( $plugin ) {
			if ( empty( $plugin['slug'] ) || empty( $plugin['name'] ) ) {
				return;
			}

			if ( empty( $plugin['slug'] ) || ! is_string( $plugin['slug'] ) || isset( $this->plugins[ $plugin['slug'] ] ) ) {
				return;
			}

			$defaults = array(
				'name'               => '',
				'slug'               => '',
				'source'             => 'repo',
				'required'           => false,
				'version'            => '',
				'force_activation'   => false,
				'force_deactivation' => false,
				'external_url'       => '',
				'is_callable'        => '',
			);

			$plugin = wp_parse_args( $plugin, $defaults );

			$plugin['slug'] = $this->sanitize_key( $plugin['slug'] );

			$plugin['version']            = (string) $plugin['version'];
			$plugin['source']             = empty( $plugin['source'] ) ? 'repo' : $plugin['source'];
			$plugin['required']           = TGMPA_Utils::validate_bool( $plugin['required'] );
			$plugin['force_activation']   = TGMPA_Utils::validate_bool( $plugin['force_activation'] );
			$plugin['force_deactivation'] = TGMPA_Utils::validate_bool( $plugin['force_deactivation'] );

			$plugin['file_path']   = $this->_get_plugin_basename_from_slug( $plugin['slug'] );
			$plugin['source_type'] = $this->get_plugin_source_type( $plugin['source'] );

			$this->plugins[ $plugin['slug'] ]    = $plugin;
			$this->sort_order[ $plugin['slug'] ] = $plugin['name'];

			if ( true === $plugin['force_activation'] ) {
				$this->has_forced_activation = true;
			}

			if ( true === $plugin['force_deactivation'] ) {
				$this->has_forced_deactivation = true;
			}
		}

		protected function get_plugin_source_type( $source ) {
			if ( 'repo' === $source || preg_match( self::WP_REPO_REGEX, $source ) ) {
				return 'repo';
			} elseif ( preg_match( self::IS_URL_REGEX, $source ) ) {
				return 'external';
			} else {
				return 'bundled';
			}
		}

		public function sanitize_key( $key ) {
			$raw_key = $key;
			$key     = preg_replace( '`[^A-Za-z0-9_-]`', '', $key );

			return apply_filters( 'tgmpa_sanitize_key', $key, $raw_key );
		}

		public function config( $config ) {
			$keys = array(
				'id',
				'default_path',
				'has_notices',
				'dismissable',
				'dismiss_msg',
				'menu',
				'parent_slug',
				'capability',
				'is_automatic',
				'message',
				'strings',
			);

			foreach ( $keys as $key ) {
				if ( isset( $config[ $key ] ) ) {
					if ( is_array( $config[ $key ] ) ) {
						$this->$key = array_merge( $this->$key, $config[ $key ] );
					} else {
						$this->$key = $config[ $key ];
					}
				}
			}
		}

		public function actions( $install_actions ) {
			if ( $this->is_tgmpa_page() ) {
				return false;
			}

			return $install_actions;
		}

		public function flush_plugins_cache( $clear_update_cache = true ) {
			wp_clean_plugins_cache( $clear_update_cache );
		}

		public function populate_file_path( $plugin_slug = '' ) {
			if ( ! empty( $plugin_slug ) && is_string( $plugin_slug ) && isset( $this->plugins[ $plugin_slug ] ) ) {
				$this->plugins[ $plugin_slug ]['file_path'] = $this->_get_plugin_basename_from_slug( $plugin_slug );
			} else {
				foreach ( $this->plugins as $slug => $values ) {
					$this->plugins[ $slug ]['file_path'] = $this->_get_plugin_basename_from_slug( $slug );
				}
			}
		}

		protected function _get_plugin_basename_from_slug( $slug ) {
			$keys = array_keys( $this->get_plugins() );

			foreach ( $keys as $key ) {
				if ( preg_match( '|^' . $slug . '/|', $key ) ) {
					return $key;
				}
			}

			return $slug;
		}

		public function _get_plugin_data_from_name( $name, $data = 'slug' ) {
			foreach ( $this->plugins as $values ) {
				if ( $name === $values['name'] && isset( $values[ $data ] ) ) {
					return $values[ $data ];
				}
			}

			return false;
		}

		public function get_download_url( $slug ) {
			$dl_source = '';

			switch ( $this->plugins[ $slug ]['source_type'] ) {
				case 'repo':
					return $this->get_wp_repo_download_url( $slug );
				case 'external':
					return $this->plugins[ $slug ]['source'];
				case 'bundled':
					return $this->default_path . $this->plugins[ $slug ]['source'];
			}

			return $dl_source;
		}

		protected function get_wp_repo_download_url( $slug ) {
			$source = '';
			$api    = $this->get_plugins_api( $slug );

			if ( false !== $api && isset( $api->download_link ) ) {
				$source = $api->download_link;
			}

			return $source;
		}

		protected function get_plugins_api( $slug ) {
			static $api = array();

			if ( ! isset( $api[ $slug ] ) ) {
				if ( ! function_exists( 'plugins_api' ) ) {
					require_once ABSPATH . 'wp-admin/includes/plugin-install.php';
				}

				$response = plugins_api( 'plugin_information', array( 'slug' => $slug, 'fields' => array( 'sections' => false ) ) );

				$api[ $slug ] = false;

				if ( is_wp_error( $response ) ) {
					wp_die( esc_attr( $this->strings['oops'] ) );
				} else {
					$api[ $slug ] = $response;
				}
			}

			return $api[ $slug ];
		}

		public function get_info_link( $slug ) {
			if ( ! empty( $this->plugins[ $slug ]['external_url'] ) && preg_match( self::IS_URL_REGEX, $this->plugins[ $slug ]['external_url'] ) ) {
				$link = sprintf(
					'<a href="%1$s" target="_blank">%2$s</a>',
					esc_url( $this->plugins[ $slug ]['external_url'] ),
                    esc_attr( $this->plugins[ $slug ]['name'] )
				);
			} elseif ( 'repo' === $this->plugins[ $slug ]['source_type'] ) {
				$url = add_query_arg(
					array(
						'tab'       => 'plugin-information',
						'plugin'    => urlencode( $slug ),
						'TB_iframe' => 'true',
						'width'     => '640',
						'height'    => '500',
					),
					self_admin_url( 'plugin-install.php' )
				);

				$link = sprintf(
					'<a href="%1$s" class="thickbox">%2$s</a>',
					esc_url( $url ),
                    esc_attr( $this->plugins[ $slug ]['name'] )
				);
			} else {
				$link = esc_attr( $this->plugins[ $slug ]['name'] );
			}

			return $link;
		}

		protected function is_tgmpa_page() {
			return isset( $_GET['page'] ) && $this->menu === $_GET['page'];
		}

		protected function is_core_update_page() {
			if ( ! function_exists( 'get_current_screen' ) ) {
				return false;
			}

			$screen = get_current_screen();

			if ( 'update-core' === $screen->base ) {
				return true;
			} elseif ( 'plugins' === $screen->base && ! empty( $_POST['action'] ) ) {
				return true;
			} elseif ( 'update' === $screen->base && ! empty( $_POST['action'] ) ) {
				return true;
			}

			return false;
		}

		public function get_tgmpa_url() {
			static $url;

			if ( ! isset( $url ) ) {
				$parent = $this->parent_slug;
				if ( false === strpos( $parent, '.php' ) ) {
					$parent = 'admin.php';
				}
				$url = add_query_arg(
					array(
						'page' => urlencode( $this->menu ),
					),
					self_admin_url( $parent )
				);
			}

			return $url;
		}

		public function get_tgmpa_status_url( $status ) {
			return add_query_arg(
				array(
					'plugin_status' => urlencode( $status ),
				),
				$this->get_tgmpa_url()
			);
		}

		public function is_tgmpa_complete() {
			$complete = true;
			foreach ( $this->plugins as $slug => $plugin ) {
				if ( ! $this->is_plugin_active( $slug ) || false !== $this->does_plugin_have_update( $slug ) ) {
					$complete = false;
					break;
				}
			}

			return $complete;
		}

		public function is_plugin_installed( $slug ) {
			$installed_plugins = $this->get_plugins();

			return ( ! empty( $installed_plugins[ $this->plugins[ $slug ]['file_path'] ] ) );
		}

		public function is_plugin_active( $slug ) {
			return ( ( ! empty( $this->plugins[ $slug ]['is_callable'] ) && is_callable( $this->plugins[ $slug ]['is_callable'] ) ) || is_plugin_active( $this->plugins[ $slug ]['file_path'] ) );
		}

		public function can_plugin_update( $slug ) {
			if ( 'repo' !== $this->plugins[ $slug ]['source_type'] ) {
				return true;
			}

			$api = $this->get_plugins_api( $slug );

			if ( false !== $api && isset( $api->requires ) ) {
				return version_compare( $this->wp_version, $api->requires, '>=' );
			}

			return true;
		}

		public function is_plugin_updatetable( $slug ) {
			if ( ! $this->is_plugin_installed( $slug ) ) {
				return false;
			} else {
				return ( false !== $this->does_plugin_have_update( $slug ) && $this->can_plugin_update( $slug ) );
			}
		}

		public function can_plugin_activate( $slug ) {
			return ( ! $this->is_plugin_active( $slug ) && ! $this->does_plugin_require_update( $slug ) );
		}

		public function get_installed_version( $slug ) {
			$installed_plugins = $this->get_plugins();

			if ( ! empty( $installed_plugins[ $this->plugins[ $slug ]['file_path'] ]['Version'] ) ) {
				return $installed_plugins[ $this->plugins[ $slug ]['file_path'] ]['Version'];
			}

			return '';
		}

		public function does_plugin_require_update( $slug ) {
			$installed_version = $this->get_installed_version( $slug );
			$minimum_version   = $this->plugins[ $slug ]['version'];

			return version_compare( $minimum_version, $installed_version, '>' );
		}

		public function does_plugin_have_update( $slug ) {
			if ( 'repo' !== $this->plugins[ $slug ]['source_type'] ) {
				if ( $this->does_plugin_require_update( $slug ) ) {
					return $this->plugins[ $slug ]['version'];
				}

				return false;
			}

			$repo_updates = get_site_transient( 'update_plugins' );

			if ( isset( $repo_updates->response[ $this->plugins[ $slug ]['file_path'] ]->new_version ) ) {
				return $repo_updates->response[ $this->plugins[ $slug ]['file_path'] ]->new_version;
			}

			return false;
		}

		public function get_upgrade_notice( $slug ) {
			if ( 'repo' !== $this->plugins[ $slug ]['source_type'] ) {
				return '';
			}

			$repo_updates = get_site_transient( 'update_plugins' );

			if ( ! empty( $repo_updates->response[ $this->plugins[ $slug ]['file_path'] ]->upgrade_notice ) ) {
				return $repo_updates->response[ $this->plugins[ $slug ]['file_path'] ]->upgrade_notice;
			}

			return '';
		}

		public function get_plugins( $plugin_folder = '' ) {
			if ( ! function_exists( 'get_plugins' ) ) {
				require_once ABSPATH . 'wp-admin/includes/plugin.php';
			}

			return get_plugins( $plugin_folder );
		}

		public function update_dismiss() {
			delete_metadata( 'user', null, 'tgmpa_dismissed_notice_' . $this->id, null, true );
		}

		public function force_activation() {
			foreach ( $this->plugins as $slug => $plugin ) {
				if ( true === $plugin['force_activation'] ) {
					if ( ! $this->is_plugin_installed( $slug ) ) {
						continue;
					} elseif ( $this->can_plugin_activate( $slug ) ) {
						activate_plugin( $plugin['file_path'] );
					}
				}
			}
		}
		public function force_deactivation() {
			$deactivated = array();

			foreach ( $this->plugins as $slug => $plugin ) {
				if ( true === $plugin['force_deactivation'] && is_plugin_active( $plugin['file_path'] ) ) {
					deactivate_plugins( $plugin['file_path'] );
					$deactivated[ $plugin['file_path'] ] = time();
				}
			}

			if ( ! empty( $deactivated ) ) {
				update_option( 'recently_activated', $deactivated + (array) get_option( 'recently_activated' ) );
			}
		}

		public function show_tgmpa_version() {
			echo '<p style="float: right; padding: 0em 1.5em 0.5em 0;"><strong><small>',
				esc_html(
					sprintf(
						__( 'TGMPA v%s', 'clubio' ),
						self::TGMPA_VERSION
					)
				),
				'</small></strong></p>';
		}

		public static function get_instance() {
			if ( ! isset( self::$instance ) && ! ( self::$instance instanceof self ) ) {
				self::$instance = new self();
			}

			return self::$instance;
		}
	}

	if ( ! function_exists( 'load_tgm_plugin_activation' ) ) {
		function load_tgm_plugin_activation() {
			$GLOBALS['tgmpa'] = TGM_Plugin_Activation::get_instance();
		}
	}

	if ( did_action( 'plugins_loaded' ) ) {
		load_tgm_plugin_activation();
	} else {
		add_action( 'plugins_loaded', 'load_tgm_plugin_activation' );
	}
}

if ( ! function_exists( 'tgmpa' ) ) {
	function tgmpa( $plugins, $config = array() ) {
		$instance = call_user_func( array( get_class( $GLOBALS['tgmpa'] ), 'get_instance' ) );

		foreach ( $plugins as $plugin ) {
			call_user_func( array( $instance, 'register' ), $plugin );
		}

		if ( ! empty( $config ) && is_array( $config ) ) {
			if ( isset( $config['notices'] ) ) {
				_deprecated_argument( __FUNCTION__, '2.2.0', 'The `notices` config parameter was renamed to `has_notices` in TGMPA 2.2.0. Please adjust your configuration.' );
				if ( ! isset( $config['has_notices'] ) ) {
					$config['has_notices'] = $config['notices'];
				}
			}

			if ( isset( $config['parent_menu_slug'] ) ) {
				_deprecated_argument( __FUNCTION__, '2.4.0', 'The `parent_menu_slug` config parameter was removed in TGMPA 2.4.0. In TGMPA 2.5.0 an alternative was (re-)introduced. Please adjust your configuration. For more information visit the website: http://tgmpluginactivation.com/configuration/#h-configuration-options.' );
			}
			if ( isset( $config['parent_url_slug'] ) ) {
				_deprecated_argument( __FUNCTION__, '2.4.0', 'The `parent_url_slug` config parameter was removed in TGMPA 2.4.0. In TGMPA 2.5.0 an alternative was (re-)introduced. Please adjust your configuration. For more information visit the website: http://tgmpluginactivation.com/configuration/#h-configuration-options.' );
			}

			call_user_func( array( $instance, 'config' ), $config );
		}
	}
}

if ( ! class_exists( 'WP_List_Table' ) ) {
	require_once ABSPATH . 'wp-admin/includes/class-wp-list-table.php';
}

if ( ! class_exists( 'TGMPA_List_Table' ) ) {
	class TGMPA_List_Table extends WP_List_Table {
		protected $tgmpa;
		public $view_context = 'all';
		protected $view_totals = array(
			'all'      => 0,
			'install'  => 0,
			'update'   => 0,
			'activate' => 0,
		);

		public function __construct() {
			$this->tgmpa = call_user_func( array( get_class( $GLOBALS['tgmpa'] ), 'get_instance' ) );

			parent::__construct(
				array(
					'singular' => 'plugin',
					'plural'   => 'plugins',
					'ajax'     => false,
				)
			);

			if ( isset( $_REQUEST['plugin_status'] ) && in_array( $_REQUEST['plugin_status'], array( 'install', 'update', 'activate' ), true ) ) {
				$this->view_context = sanitize_key( $_REQUEST['plugin_status'] );
			}

			add_filter( 'tgmpa_table_data_items', array( $this, 'sort_table_items' ) );
		}

		public function get_table_classes() {
			return array( 'widefat', 'fixed' );
		}
		protected function _gather_plugin_data() {
			$this->tgmpa->admin_init();
			$this->tgmpa->thickbox();

			$plugins = $this->categorize_plugins_to_views();

			$this->set_view_totals( $plugins );

			$table_data = array();
			$i          = 0;

			if ( empty( $plugins[ $this->view_context ] ) ) {
				$this->view_context = 'all';
			}

			foreach ( $plugins[ $this->view_context ] as $slug => $plugin ) {
				$table_data[ $i ]['sanitized_plugin']  = $plugin['name'];
				$table_data[ $i ]['slug']              = $slug;
				$table_data[ $i ]['plugin']            = '<strong>' . $this->tgmpa->get_info_link( $slug ) . '</strong>';
				$table_data[ $i ]['source']            = $this->get_plugin_source_type_text( $plugin['source_type'] );
				$table_data[ $i ]['type']              = $this->get_plugin_advise_type_text( $plugin['required'] );
				$table_data[ $i ]['status']            = $this->get_plugin_status_text( $slug );
				$table_data[ $i ]['installed_version'] = $this->tgmpa->get_installed_version( $slug );
				$table_data[ $i ]['minimum_version']   = $plugin['version'];
				$table_data[ $i ]['available_version'] = $this->tgmpa->does_plugin_have_update( $slug );

				$upgrade_notice = $this->tgmpa->get_upgrade_notice( $slug );
				if ( ! empty( $upgrade_notice ) ) {
					$table_data[ $i ]['upgrade_notice'] = $upgrade_notice;

					add_action( "tgmpa_after_plugin_row_{$slug}", array( $this, 'wp_plugin_update_row' ), 10, 2 );
				}

				$table_data[ $i ] = apply_filters( 'tgmpa_table_data_item', $table_data[ $i ], $plugin );

				$i++;
			}

			return $table_data;
		}
		protected function categorize_plugins_to_views() {
			$plugins = array(
				'all'      => array(),
				'install'  => array(),
				'update'   => array(),
				'activate' => array(),
			);

			foreach ( $this->tgmpa->plugins as $slug => $plugin ) {
				if ( $this->tgmpa->is_plugin_active( $slug ) && false === $this->tgmpa->does_plugin_have_update( $slug ) ) {
					continue;
				} else {
					$plugins['all'][ $slug ] = $plugin;

					if ( ! $this->tgmpa->is_plugin_installed( $slug ) ) {
						$plugins['install'][ $slug ] = $plugin;
					} else {
						if ( false !== $this->tgmpa->does_plugin_have_update( $slug ) ) {
							$plugins['update'][ $slug ] = $plugin;
						}

						if ( $this->tgmpa->can_plugin_activate( $slug ) ) {
							$plugins['activate'][ $slug ] = $plugin;
						}
					}
				}
			}

			return $plugins;
		}
		protected function set_view_totals( $plugins ) {
			foreach ( $plugins as $type => $list ) {
				$this->view_totals[ $type ] = count( $list );
			}
		}

		protected function get_plugin_advise_type_text( $required ) {
			if ( true === $required ) {
				return __( 'Required', 'clubio' );
			}

			return __( 'Recommended', 'clubio' );
		}

		protected function get_plugin_source_type_text( $type ) {
			$string = '';

			switch ( $type ) {
				case 'repo':
					$string = esc_html__( 'WordPress Repository', 'clubio' );
					break;
				case 'external':
					$string = esc_html__( 'External Source', 'clubio' );
					break;
				case 'bundled':
					$string = esc_html__( 'Pre-Packaged', 'clubio' );
					break;
			}

			return $string;
		}

		protected function get_plugin_status_text( $slug ) {
			if ( ! $this->tgmpa->is_plugin_installed( $slug ) ) {
				return __( 'Not Installed', 'clubio' );
			}

			if ( ! $this->tgmpa->is_plugin_active( $slug ) ) {
				$install_status = esc_html__( 'Installed But Not Activated', 'clubio' );
			} else {
				$install_status = esc_html__( 'Active', 'clubio' );
			}

			$update_status = '';

			if ( $this->tgmpa->does_plugin_require_update( $slug ) && false === $this->tgmpa->does_plugin_have_update( $slug ) ) {
				$update_status = esc_html__( 'Required Update not Available', 'clubio' );

			} elseif ( $this->tgmpa->does_plugin_require_update( $slug ) ) {
				$update_status = esc_html__( 'Requires Update', 'clubio' );

			} elseif ( false !== $this->tgmpa->does_plugin_have_update( $slug ) ) {
				$update_status = esc_html__( 'Update recommended', 'clubio' );
			}

			if ( '' === $update_status ) {
				return $install_status;
			}

			return sprintf(
				_x( '%1$s, %2$s', 'Install/Update Status', 'clubio' ),
				$install_status,
				$update_status
			);
		}
		public function sort_table_items( $items ) {
			$type = array();
			$name = array();

			foreach ( $items as $i => $plugin ) {
				$type[ $i ] = $plugin['type'];
				$name[ $i ] = $plugin['sanitized_plugin'];
			}

			array_multisort( $type, SORT_DESC, $name, SORT_ASC, $items );

			return $items;
		}
		public function get_views() {
			$status_links = array();

			foreach ( $this->view_totals as $type => $count ) {
				if ( $count < 1 ) {
					continue;
				}

				switch ( $type ) {
					case 'all':
						$text = _nx( 'All <span class="count">(%s)</span>', 'All <span class="count">(%s)</span>', $count, 'plugins', 'clubio' );
						break;
					case 'install':
						$text = _n( 'To Install <span class="count">(%s)</span>', 'To Install <span class="count">(%s)</span>', $count, 'clubio' );
						break;
					case 'update':
						$text = _n( 'Update Available <span class="count">(%s)</span>', 'Update Available <span class="count">(%s)</span>', $count, 'clubio' );
						break;
					case 'activate':
						$text = _n( 'To Activate <span class="count">(%s)</span>', 'To Activate <span class="count">(%s)</span>', $count, 'clubio' );
						break;
					default:
						$text = '';
						break;
				}

				if ( ! empty( $text ) ) {

					$status_links[ $type ] = sprintf(
						'<a href="%s"%s>%s</a>',
						esc_url( $this->tgmpa->get_tgmpa_status_url( $type ) ),
						( $type === $this->view_context ) ? ' class="current"' : '',
						sprintf( $text, number_format_i18n( $count ) )
					);
				}
			}

			return $status_links;
		}
		public function column_default( $item, $column_name ) {
			return $item[ $column_name ];
		}
		public function column_cb( $item ) {
			return sprintf(
				'<input type="checkbox" name="%1$s[]" value="%2$s" id="%3$s" />',
				esc_attr( $this->_args['singular'] ),
				esc_attr( $item['slug'] ),
				esc_attr( $item['sanitized_plugin'] )
			);
		}
		public function column_plugin( $item ) {
			return sprintf(
				'%1$s %2$s',
				$item['plugin'],
				$this->row_actions( $this->get_row_actions( $item ), true )
			);
		}

		public function column_version( $item ) {
			$output = array();

			if ( $this->tgmpa->is_plugin_installed( $item['slug'] ) ) {
				$installed = ! empty( $item['installed_version'] ) ? $item['installed_version'] : _x( 'unknown', 'as in: "version nr unknown"', 'clubio' );

				$color = '';
				if ( ! empty( $item['minimum_version'] ) && $this->tgmpa->does_plugin_require_update( $item['slug'] ) ) {
					$color = ' color: #ff0000; font-weight: bold;';
				}

				$output[] = sprintf(
					'<p><span style="min-width: 32px; text-align: right; float: right;%1$s">%2$s</span>' . __( 'Installed version:', 'clubio' ) . '</p>',
					$color,
					$installed
				);
			}

			if ( ! empty( $item['minimum_version'] ) ) {
				$output[] = sprintf(
					'<p><span style="min-width: 32px; text-align: right; float: right;">%1$s</span>' . __( 'Minimum required version:', 'clubio' ) . '</p>',
					$item['minimum_version']
				);
			}

			if ( ! empty( $item['available_version'] ) ) {
				$color = '';
				if ( ! empty( $item['minimum_version'] ) && version_compare( $item['available_version'], $item['minimum_version'], '>=' ) ) {
					$color = ' color: #71C671; font-weight: bold;';
				}

				$output[] = sprintf(
					'<p><span style="min-width: 32px; text-align: right; float: right;%1$s">%2$s</span>' . __( 'Available version:', 'clubio' ) . '</p>',
					$color,
					$item['available_version']
				);
			}

			if ( empty( $output ) ) {
				return '&nbsp;';
			} else {
				return implode( "\n", $output );
			}
		}
		public function no_items() {
			echo esc_html__( 'No plugins to install, update or activate.', 'clubio' ) . ' <a href="' . esc_url( self_admin_url() ) . '"> ' . esc_html__( 'Return to the Dashboard', 'clubio' ) . '</a>';
			echo '<style type="text/css">#adminmenu .wp-submenu li.current { display: none !important; }</style>';
		}

		public function get_columns() {
			$columns = array(
				'cb'     => '<input type="checkbox" />',
				'plugin' => esc_html__( 'Plugin', 'clubio' ),
				'source' => esc_html__( 'Source', 'clubio' ),
				'type'   => esc_html__( 'Type', 'clubio' ),
			);

			if ( 'all' === $this->view_context || 'update' === $this->view_context ) {
				$columns['version'] = esc_html__( 'Version', 'clubio' );
				$columns['status']  = esc_html__( 'Status', 'clubio' );
			}

			return apply_filters( 'tgmpa_table_columns', $columns );
		}

		protected function get_default_primary_column_name() {
			return 'plugin';
		}

		protected function get_primary_column_name() {
			if ( method_exists( 'WP_List_Table', 'get_primary_column_name' ) ) {
				return parent::get_primary_column_name();
			} else {
				return $this->get_default_primary_column_name();
			}
		}
		protected function get_row_actions( $item ) {
			$actions      = array();
			$action_links = array();

			if ( ! $this->tgmpa->is_plugin_installed( $item['slug'] ) ) {
				$actions['install'] = esc_html__( 'Install %2$s', 'clubio' );
			} else {
				if ( false !== $this->tgmpa->does_plugin_have_update( $item['slug'] ) && $this->tgmpa->can_plugin_update( $item['slug'] ) ) {
					$actions['update'] = esc_html__( 'Update %2$s', 'clubio' );
				}

				if ( $this->tgmpa->can_plugin_activate( $item['slug'] ) ) {
					$actions['activate'] = esc_html__( 'Activate %2$s', 'clubio' );
				}
			}

			foreach ( $actions as $action => $text ) {
				$nonce_url = wp_nonce_url(
					add_query_arg(
						array(
							'plugin'           => urlencode( $item['slug'] ),
							'tgmpa-' . $action => $action . '-plugin',
						),
						$this->tgmpa->get_tgmpa_url()
					),
					'tgmpa-' . $action,
					'tgmpa-nonce'
				);

				$action_links[ $action ] = sprintf(
					'<a href="%1$s">' . esc_attr( $text ) . '</a>',
					esc_url( $nonce_url ),
					'<span class="screen-reader-text">' . esc_attr( $item['sanitized_plugin'] ) . '</span>'
				);
			}

			$prefix = ( defined( 'WP_NETWORK_ADMIN' ) && WP_NETWORK_ADMIN ) ? 'network_admin_' : '';
			return apply_filters( "tgmpa_{$prefix}plugin_action_links", array_filter( $action_links ), $item['slug'], $item, $this->view_context );
		}

		public function single_row( $item ) {
			parent::single_row( $item );
			do_action( "tgmpa_after_plugin_row_{$item['slug']}", $item['slug'], $item, $this->view_context );
		}

		public function wp_plugin_update_row( $slug, $item ) {
			if ( empty( $item['upgrade_notice'] ) ) {
				return;
			}

			echo '
				<tr class="plugin-update-tr">
					<td colspan="', absint( $this->get_column_count() ), '" class="plugin-update colspanchange">
						<div class="update-message">',
            esc_html__( 'Upgrade message from the plugin author:', 'clubio' ),
							' <strong>', wp_kses_data( $item['upgrade_notice'] ), '</strong>
						</div>
					</td>
				</tr>';
		}

		public function extra_tablenav( $which ) {
			if ( 'bottom' === $which ) {
				$this->tgmpa->show_tgmpa_version();
			}
		}

		public function get_bulk_actions() {

			$actions = array();

			if ( 'update' !== $this->view_context && 'activate' !== $this->view_context ) {
				if ( current_user_can( 'install_plugins' ) ) {
					$actions['tgmpa-bulk-install'] = esc_html__( 'Install', 'clubio' );
				}
			}

			if ( 'install' !== $this->view_context ) {
				if ( current_user_can( 'update_plugins' ) ) {
					$actions['tgmpa-bulk-update'] = esc_html__( 'Update', 'clubio' );
				}
				if ( current_user_can( 'activate_plugins' ) ) {
					$actions['tgmpa-bulk-activate'] = esc_html__( 'Activate', 'clubio' );
				}
			}

			return $actions;
		}
		public function process_bulk_actions() {
			if ( 'tgmpa-bulk-install' === $this->current_action() || 'tgmpa-bulk-update' === $this->current_action() ) {

				check_admin_referer( 'bulk-' . $this->_args['plural'] );

				$install_type = 'install';
				if ( 'tgmpa-bulk-update' === $this->current_action() ) {
					$install_type = 'update';
				}

				$plugins_to_install = array();

				if ( empty( $_POST['plugin'] ) ) {
					if ( 'install' === $install_type ) {
						$message = esc_html__( 'No plugins were selected to be installed. No action taken.', 'clubio' );
					} else {
						$message = esc_html__( 'No plugins were selected to be updated. No action taken.', 'clubio' );
					}

					echo '<div id="message" class="error"><p>', esc_html( $message ), '</p></div>';

					return false;
				}

				if ( is_array( $_POST['plugin'] ) ) {
					$plugins_to_install = (array) $_POST['plugin'];
				} elseif ( is_string( $_POST['plugin'] ) ) {
					$plugins_to_install = explode( ',', $_POST['plugin'] );
				}

				$plugins_to_install = array_map( 'urldecode', $plugins_to_install );
				$plugins_to_install = array_map( array( $this->tgmpa, 'sanitize_key' ), $plugins_to_install );

				foreach ( $plugins_to_install as $key => $slug ) {
					if ( ! isset( $this->tgmpa->plugins[ $slug ] ) ) {
						unset( $plugins_to_install[ $key ] );
						continue;
					}

					if ( 'install' === $install_type && true === $this->tgmpa->is_plugin_installed( $slug ) ) {
						unset( $plugins_to_install[ $key ] );
					}

					if ( 'update' === $install_type && false === $this->tgmpa->is_plugin_updatetable( $slug ) ) {
						unset( $plugins_to_install[ $key ] );
					}
				}

				if ( empty( $plugins_to_install ) ) {
					if ( 'install' === $install_type ) {
						$message = esc_html__( 'No plugins are available to be installed at this time.', 'clubio' );
					} else {
						$message = esc_html__( 'No plugins are available to be updated at this time.', 'clubio' );
					}

					echo '<div id="message" class="error"><p>', esc_html( $message ), '</p></div>';

					return false;
				}

				$url = wp_nonce_url(
					$this->tgmpa->get_tgmpa_url(),
					'bulk-' . $this->_args['plural']
				);

				$_POST['plugin'] = implode( ',', $plugins_to_install );

				$method = '';
				$fields = array_keys( $_POST );

				if ( false === ( $creds = request_filesystem_credentials( esc_url_raw( $url ), $method, false, false, $fields ) ) ) {
					return true;
				}

				if ( ! WP_Filesystem( $creds ) ) {
					request_filesystem_credentials( esc_url_raw( $url ), $method, true, false, $fields );

					return true;
				}
				$names      = array();
				$sources    = array();
				$file_paths = array();
				$to_inject  = array();

				foreach ( $plugins_to_install as $slug ) {
					$name   = $this->tgmpa->plugins[ $slug ]['name'];
					$source = $this->tgmpa->get_download_url( $slug );

					if ( ! empty( $name ) && ! empty( $source ) ) {
						$names[] = $name;

						switch ( $install_type ) {

							case 'install':
								$sources[] = $source;
								break;

							case 'update':
								$file_paths[]                 = $this->tgmpa->plugins[ $slug ]['file_path'];
								$to_inject[ $slug ]           = $this->tgmpa->plugins[ $slug ];
								$to_inject[ $slug ]['source'] = $source;
								break;
						}
					}
				}
				unset( $slug, $name, $source );

				$installer = new TGMPA_Bulk_Installer(
					new TGMPA_Bulk_Installer_Skin(
						array(
							'url'          => esc_url_raw( $this->tgmpa->get_tgmpa_url() ),
							'nonce'        => 'bulk-' . $this->_args['plural'],
							'names'        => $names,
							'install_type' => $install_type,
						)
					)
				);

				echo '<div class="tgmpa">',
					'<h2 style="font-size: 23px; font-weight: 400; line-height: 29px; margin: 0; padding: 9px 15px 4px 0;">', esc_attr( get_admin_page_title() ), '</h2>
					<div class="update-php" style="width: 100%; height: 98%; min-height: 850px; padding-top: 1px;">';

				add_filter( 'upgrader_source_selection', array( $this->tgmpa, 'maybe_adjust_source_dir' ), 1, 3 );

				if ( 'tgmpa-bulk-update' === $this->current_action() ) {
					$this->tgmpa->inject_update_info( $to_inject );

					$installer->bulk_upgrade( $file_paths );
				} else {
					$installer->bulk_install( $sources );
				}

				remove_filter( 'upgrader_source_selection', array( $this->tgmpa, 'maybe_adjust_source_dir' ), 1 );

				echo '</div></div>';

				return true;
			}

			if ( 'tgmpa-bulk-activate' === $this->current_action() ) {
				check_admin_referer( 'bulk-' . $this->_args['plural'] );

				if ( empty( $_POST['plugin'] ) ) {
					echo '<div id="message" class="error"><p>', esc_html__( 'No plugins were selected to be activated. No action taken.', 'clubio' ), '</p></div>';

					return false;
				}

				$plugins = array();
				if ( isset( $_POST['plugin'] ) ) {
					$plugins = array_map( 'urldecode', (array) $_POST['plugin'] );
					$plugins = array_map( array( $this->tgmpa, 'sanitize_key' ), $plugins );
				}

				$plugins_to_activate = array();
				$plugin_names        = array();

				foreach ( $plugins as $slug ) {
					if ( $this->tgmpa->can_plugin_activate( $slug ) ) {
						$plugins_to_activate[] = $this->tgmpa->plugins[ $slug ]['file_path'];
						$plugin_names[]        = $this->tgmpa->plugins[ $slug ]['name'];
					}
				}
				unset( $slug );

				if ( empty( $plugins_to_activate ) ) {
					echo '<div id="message" class="error"><p>', esc_html__( 'No plugins are available to be activated at this time.', 'clubio' ), '</p></div>';

					return false;
				}

				$activate = activate_plugins( $plugins_to_activate );

				if ( is_wp_error( $activate ) ) {
					echo '<div id="message" class="error"><p>', wp_kses_post( $activate->get_error_message() ), '</p></div>';
				} else {
					$count        = count( $plugin_names );
					$plugin_names = array_map( array( 'TGMPA_Utils', 'wrap_in_strong' ), $plugin_names );
					$last_plugin  = array_pop( $plugin_names );
					$imploded     = empty( $plugin_names ) ? $last_plugin : ( implode( ', ', $plugin_names ) . ' ' . esc_html_x( 'and', 'plugin A *and* plugin B', 'clubio' ) . ' ' . $last_plugin );

					printf(
						'<div id="message" class="updated"><p>%1$s %2$s.</p></div>',
						esc_html( _n( 'The following plugin was activated successfully:', 'The following plugins were activated successfully:', $count, 'clubio' ) ),
						$imploded
					);

					$recent = (array) get_option( 'recently_activated' );
					foreach ( $plugins_to_activate as $plugin => $time ) {
						if ( isset( $recent[ $plugin ] ) ) {
							unset( $recent[ $plugin ] );
						}
					}
					update_option( 'recently_activated', $recent );
				}

				unset( $_POST );

				return true;
			}

			return false;
		}

		public function prepare_items() {
			$columns               = $this->get_columns();
			$hidden                = array();
			$sortable              = array();
			$primary               = $this->get_primary_column_name();
			$this->_column_headers = array( $columns, $hidden, $sortable, $primary );

			if ( 'tgmpa-bulk-activate' === $this->current_action() ) {
				$this->process_bulk_actions();
			}

			$this->items = apply_filters( 'tgmpa_table_data_items', $this->_gather_plugin_data() );
		}

		protected function _get_plugin_data_from_name( $name, $data = 'slug' ) {
			_deprecated_function( __FUNCTION__, 'TGMPA 2.5.0', 'TGM_Plugin_Activation::_get_plugin_data_from_name()' );

			return $this->tgmpa->_get_plugin_data_from_name( $name, $data );
		}
	}
}


if ( ! class_exists( 'TGM_Bulk_Installer' ) ) {
	class TGM_Bulk_Installer {
	}
}
if ( ! class_exists( 'TGM_Bulk_Installer_Skin' ) ) {
	class TGM_Bulk_Installer_Skin {
	}
}
add_action( 'admin_init', 'tgmpa_load_bulk_installer' );
if ( ! function_exists( 'tgmpa_load_bulk_installer' ) ) {
	function tgmpa_load_bulk_installer() {
		if ( ! isset( $GLOBALS['tgmpa'] ) ) {
			return;
		}

		$tgmpa_instance = call_user_func( array( get_class( $GLOBALS['tgmpa'] ), 'get_instance' ) );

		if ( isset( $_GET['page'] ) && $tgmpa_instance->menu === $_GET['page'] ) {
			if ( ! class_exists( 'Plugin_Upgrader', false ) ) {
				require_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
			}

			if ( ! class_exists( 'TGMPA_Bulk_Installer' ) ) {
				class TGMPA_Bulk_Installer extends Plugin_Upgrader {
					public $result;

					public $bulk = false;

					protected $tgmpa;

					protected $clear_destination = false;
					public function __construct( $skin = null ) {
						$this->tgmpa = call_user_func( array( get_class( $GLOBALS['tgmpa'] ), 'get_instance' ) );

						parent::__construct( $skin );

						if ( isset( $this->skin->options['install_type'] ) && 'update' === $this->skin->options['install_type'] ) {
							$this->clear_destination = true;
						}

						if ( $this->tgmpa->is_automatic ) {
							$this->activate_strings();
						}

						add_action( 'upgrader_process_complete', array( $this->tgmpa, 'populate_file_path' ) );
					}
					public function activate_strings() {
						$this->strings['activation_failed']  = esc_html__( 'Plugin activation failed.', 'clubio' );
						$this->strings['activation_success'] = esc_html__( 'Plugin activated successfully.', 'clubio' );
					}

					public function run( $options ) {
						$result = parent::run( $options );

						if ( $this->tgmpa->is_automatic ) {
							if ( 'update' === $this->skin->options['install_type'] ) {
								$this->upgrade_strings();
							} else {
								$this->install_strings();
							}
						}

						return $result;
					}

					public function bulk_install( $plugins, $args = array() ) {
						add_filter( 'upgrader_post_install', array( $this, 'auto_activate' ), 10 );

						$defaults    = array(
							'clear_update_cache' => true,
						);
						$parsed_args = wp_parse_args( $args, $defaults );

						$this->init();
						$this->bulk = true;

						$this->install_strings();
						$this->skin->header();

						$res = $this->fs_connect( array( WP_CONTENT_DIR, WP_PLUGIN_DIR ) );
						if ( ! $res ) {
							$this->skin->footer();
							return false;
						}

						$this->skin->bulk_header();
						$maintenance = ( is_multisite() && ! empty( $plugins ) );
						if ( $maintenance ) {
							$this->maintenance_mode( true );
						}

						$results = array();

						$this->update_count   = count( $plugins );
						$this->update_current = 0;
						foreach ( $plugins as $plugin ) {
							$this->update_current++;

							$result = $this->run(
								array(
									'package'           => $plugin,
									'destination'       => WP_PLUGIN_DIR,
									'clear_destination' => false,
									'clear_working'     => true,
									'is_multi'          => true,
									'hook_extra'        => array(
										'plugin' => $plugin,
									),
								)
							);

							$results[ $plugin ] = $this->result;

							if ( false === $result ) {
								break;
							}
						}

						$this->maintenance_mode( false );
						do_action( 'upgrader_process_complete', $this, array(
							'action'  => 'install',
							'type'    => 'plugin',
							'bulk'    => true,
							'plugins' => $plugins,
						) );

						$this->skin->bulk_footer();

						$this->skin->footer();

						remove_filter( 'upgrader_post_install', array( $this, 'auto_activate' ), 10 );
						wp_clean_plugins_cache( $parsed_args['clear_update_cache'] );

						return $results;
					}
					public function bulk_upgrade( $plugins, $args = array() ) {

						add_filter( 'upgrader_post_install', array( $this, 'auto_activate' ), 10 );

						$result = parent::bulk_upgrade( $plugins, $args );

						remove_filter( 'upgrader_post_install', array( $this, 'auto_activate' ), 10 );

						return $result;
					}

					public function auto_activate( $bool ) {
						if ( $this->tgmpa->is_automatic ) {
							wp_clean_plugins_cache();

							$plugin_info = $this->plugin_info();

							if ( ! is_plugin_active( $plugin_info ) ) {
								$activate = activate_plugin( $plugin_info );

								$this->strings['process_success'] = $this->strings['process_success'] . "<br />\n";

								if ( is_wp_error( $activate ) ) {
									$this->skin->error( $activate );
									$this->strings['process_success'] .= $this->strings['activation_failed'];
								} else {
									$this->strings['process_success'] .= $this->strings['activation_success'];
								}
							}
						}

						return $bool;
					}
				}
			}

			if ( ! class_exists( 'TGMPA_Bulk_Installer_Skin' ) ) {

				class TGMPA_Bulk_Installer_Skin extends Bulk_Upgrader_Skin {
					public $plugin_info = array();
					public $plugin_names = array();
					public $i = 0;
					protected $tgmpa;
					public function __construct( $args = array() ) {
						$this->tgmpa = call_user_func( array( get_class( $GLOBALS['tgmpa'] ), 'get_instance' ) );

						$defaults = array(
							'url'          => '',
							'nonce'        => '',
							'names'        => array(),
							'install_type' => 'install',
						);
						$args     = wp_parse_args( $args, $defaults );

						$this->plugin_names = $args['names'];

						parent::__construct( $args );
					}
					public function add_strings() {
						if ( 'update' === $this->options['install_type'] ) {
							parent::add_strings();
							$this->upgrader->strings['skin_before_update_header'] = esc_html__( 'Updating Plugin %1$s (%2$d/%3$d)', 'clubio' );
						} else {
							$this->upgrader->strings['skin_update_failed_error'] = esc_html__( 'An error occurred while installing %1$s: <strong>%2$s</strong>.', 'clubio' );
							$this->upgrader->strings['skin_update_failed'] = esc_html__( 'The installation of %1$s failed.', 'clubio' );

                            if ( $this->tgmpa->is_automatic ) {
                                $this->upgrader->strings['skin_upgrade_start'] = esc_html__( 'The installation and activation process is starting. This process may take a while on some hosts, so please be patient.', 'clubio' );
                                $this->upgrader->strings['skin_update_successful'] = esc_html__( '%1$s installed and activated successfully.', 'clubio' );
                                $this->upgrader->strings['skin_upgrade_end']       = esc_html__( 'All installations and activations have been completed.', 'clubio' );
                                $this->upgrader->strings['skin_before_update_header'] = esc_html__( 'Installing and Activating Plugin %1$s (%2$d/%3$d)', 'clubio' );
                            } else {
                                $this->upgrader->strings['skin_upgrade_start'] = esc_html__( 'The installation process is starting. This process may take a while on some hosts, so please be patient.', 'clubio' );
                                $this->upgrader->strings['skin_update_successful'] = esc_html__( '%1$s installed successfully.', 'clubio' ) ;
                                $this->upgrader->strings['skin_upgrade_end']       = esc_html__( 'All installations have been completed.', 'clubio' );
                                $this->upgrader->strings['skin_before_update_header'] = esc_html__( 'Installing Plugin %1$s (%2$d/%3$d)', 'clubio' );
                            }
                        }
					}
					public function before( $title = '' ) {
						if ( empty( $title ) ) {
							$title = esc_attr( $this->plugin_names[ $this->i ] );
						}
						parent::before( $title );
					}
					public function after( $title = '' ) {
						if ( empty( $title ) ) {
							$title = esc_attr( $this->plugin_names[ $this->i ] );
						}
						parent::after( $title );

						$this->i++;
					}

					public function bulk_footer() {
						parent::bulk_footer();

						wp_clean_plugins_cache();

						$this->tgmpa->show_tgmpa_version();

						$update_actions = array();

						if ( $this->tgmpa->is_tgmpa_complete() ) {
							echo '<style type="text/css">#adminmenu .wp-submenu li.current { display: none !important; }</style>';
							$update_actions['dashboard'] = sprintf(
                                esc_attr( $this->tgmpa->strings['complete'] ),
								'<a href="' . esc_url( self_admin_url() ) . '">' . esc_html__( 'Return to the Dashboard', 'clubio' ) . '</a>'
							);
						} else {
							$update_actions['tgmpa_page'] = '<a href="' . esc_url( $this->tgmpa->get_tgmpa_url() ) . '" target="_parent">' . esc_attr( $this->tgmpa->strings['return'] ) . '</a>';
						}
						$update_actions = apply_filters( 'tgmpa_update_bulk_plugins_complete_actions', $update_actions, $this->plugin_info );

						if ( ! empty( $update_actions ) ) {
							$this->feedback( implode( ' | ', (array) $update_actions ) );
						}
					}
					public function before_flush_output() {
						_deprecated_function( __FUNCTION__, 'TGMPA 2.5.0', 'Bulk_Upgrader_Skin::flush_output()' );
						$this->flush_output();
					}
					public function after_flush_output() {
						_deprecated_function( __FUNCTION__, 'TGMPA 2.5.0', 'Bulk_Upgrader_Skin::flush_output()' );
						$this->flush_output();
						$this->i++;
					}
				}
			}
		}
	}
}

if ( ! class_exists( 'TGMPA_Utils' ) ) {
	class TGMPA_Utils {
		public static $has_filters;
		public static function wrap_in_em( $string ) {
			return '<em>' . wp_kses_post( $string ) . '</em>';
		}
		public static function wrap_in_strong( $string ) {
			return '<strong>' . wp_kses_post( $string ) . '</strong>';
		}
		public static function validate_bool( $value ) {
			if ( ! isset( self::$has_filters ) ) {
				self::$has_filters = extension_loaded( 'filter' );
			}

			if ( self::$has_filters ) {
				return filter_var( $value, FILTER_VALIDATE_BOOLEAN );
			} else {
				return self::emulate_filter_bool( $value );
			}
		}
		protected static function emulate_filter_bool( $value ) {
			static $true  = array(
				'1',
				'true', 'True', 'TRUE',
				'y', 'Y',
				'yes', 'Yes', 'YES',
				'on', 'On', 'ON',
			);
			static $false = array(
				'0',
				'false', 'False', 'FALSE',
				'n', 'N',
				'no', 'No', 'NO',
				'off', 'Off', 'OFF',
			);

			if ( is_bool( $value ) ) {
				return $value;
			} elseif ( is_int( $value ) && ( 0 === $value || 1 === $value ) ) {
				return (bool) $value;
			} elseif ( ( is_float( $value ) && ! is_nan( $value ) ) && ( (float) 0 === $value || (float) 1 === $value ) ) {
				return (bool) $value;
			} elseif ( is_string( $value ) ) {
				$value = trim( $value );
				if ( in_array( $value, $true, true ) ) {
					return true;
				} elseif ( in_array( $value, $false, true ) ) {
					return false;
				} else {
					return false;
				}
			}

			return false;
		}
	}
}