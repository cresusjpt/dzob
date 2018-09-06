<div class="col-md-12">
    <div class="panel-tools">
        <div class="dropdown">
            <a data-toggle="dropdown" class="btn btn-xs dropdown-toggle btn-transparent-grey">
                <i class="fa fa-cog"></i>
            </a>
            <ul class="dropdown-menu dropdown-light pull-right" role="menu">
                <li>
                    <a class="panel-collapse collapses" href="#"><i class="fa fa-angle-up"></i>
                        <span>Collapse</span> </a>
                </li>
                <li>
                    <a class="panel-refresh" href="#">
                        <i class="fa fa-refresh"></i> <span>Refresh</span>
                    </a>
                </li>
                <li>
                    <a class="panel-config" href="#panel-config" data-toggle="modal">
                        <i class="fa fa-wrench"></i> <span>Configurations</span>
                    </a>
                </li>
                <li>
                    <a class="panel-expand" href="#">
                        <i class="fa fa-expand"></i> <span>Fullscreen</span>
                    </a>
                </li>
            </ul>
        </div>
        <a class="btn btn-xs btn-link panel-close" href="#">
            <i class="fa fa-times"></i>
        </a>
    </div>
    <div class="panel-body">
        <div id="tree" class="tree-demo">
            <ul>
                <li>
                    Root node 1
                    <ul>
                        <li data-jstree='{ "selected" : true }'>
                            <a href="#">
                                Initially selected
                            </a>
                        </li>
                        <li data-jstree='{ "icon" : "fa fa-briefcase text-green " }'>
                            custom icon URL
                        </li>
                        <li data-jstree='{ "opened" : true }'>
                            initially open
                            <ul>
                                <li data-jstree='{ "disabled" : true }'>
                                    Disabled Node
                                </li>
                                <li data-jstree='{ "type" : "file" }'>
                                    Another node
                                </li>
                            </ul>
                        </li>
                        <li data-jstree='{ "icon" : "fa fa-warning text-red" }'>
                            Custom icon class (bootstrap)
                        </li>
                    </ul>
                </li>
                <li data-jstree='{ "type" : "file" }'>
                    <a href="http://www.jstree.com">
                        Clickanle link node
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>