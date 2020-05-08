<?php
/**
 * ownCloud
 *
 * @author Hari Bhandari <hari@jankaritech.com>
 * @copyright Copyright (c) 2020 Hari Bhandari hari@jankaritech.com
 *
 * This code is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License,
 * as published by the Free Software Foundation;
 * either version 3 of the License, or any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>
 *
 */
namespace TestHelpers;

use phpDocumentor\Reflection\DocBlock\Tags\Method;

/**
 * Helper for File Handling Operations
 */
class FileHandlingHelper {
	/**
	 * Helper for Recursive Copy of file/folder
	 * For more info check this out https://gist.github.com/gserrano/4c9648ec9eb293b9377b
	 *
	 * @param string $source
	 * @param string $destination
	 *
	 * @return void
	 *
	 */
	public static function copyRecursive($source, $destination) {
		$dir = \opendir($source);
		@\mkdir($destination);
		while (($file = \readdir($dir)) !== false) {
			if (($file != '.') && ($file != '..')) {
				if (\is_dir($source . '/' . $file)) {
					FileHandlingHelper::copyRecursive($source . '/' . $file, $destination . '/' . $file);
				} else {
					\copy($source . '/' . $file, $destination . '/' . $file);
				}
			}
		}
		\closedir($dir);
	}

	/**
	 * Helper for Recursive Delete of file/folder
	 *
	 * @param string $dir
	 *
	 * @return boolean
	 *
	 */
	public static function deleteRecursive($dir) {
		$files = \array_diff(\scandir($dir), ['.','..']);
		foreach ($files as $file) {
			(\is_dir("$dir/$file")) ? FileHandlingHelper::deleteRecursive("$dir/$file") : \unlink("$dir/$file");
		}
		return \rmdir($dir);
	}
}
