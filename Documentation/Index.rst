..  Editor configuration
	...................................................
	* utf-8 with BOM as encoding
	* tab indent with 4 characters for code snippet.
	* optional: soft carriage return preferred.

.. Includes roles, substitutions, ...
.. include:: _IncludedDirectives.rst

=================
Frontend Media
=================

:Extension name: Frontend Media
:Extension key: media_frontend
:Version: 0.2.1
:Description: manuals covering TYPO3 extension "Frontend Media"
:Language: en
:Author: Dirk Wenzel
:Creation: 2013-09-27
:Generation: 07:54
:Licence: Open Content License available from `www.opencontent.org/opl.shtml <http://www.opencontent.org/opl.shtml>`_

The content of this document is related to TYPO3, a GNU/GPL CMS/Framework available from `www.typo3.org
<http://www.typo3.org/>`_

**Table of Contents**

.. toctree::
	:maxdepth: 2

	ProjectInformation
.. not yet ready
	@todo: UserManual
	@todo: AdministratorManual
	@todo: TyposcriptReference
	@todo: DeveloperCorner

.. include:: ../Readme.rst

What does it do?
=================

Frontend Media allows logged in visitors of the website to manage files through the frontend. They can be added, removed, altered and shared with other users. A plugin allows to show individual files or file collections.
Each file belongs to the user who uploaded it. They can be released to the public through the backend. 

Frontend Media stores its files in a folder under the fileadmin directory. It uses file storages introduced with TYPO3 version 6.0. to manage this folder. 

.. figure:: Images/IntroductionPackage.png
		:width: 500px
		:alt: Introduction Package

		Introduction Package just after installation (caption of the image)

		How the Frontend of the Introduction Package looks like just after installation (legend of the image)
