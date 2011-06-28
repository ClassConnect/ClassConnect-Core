guider.createGuider({
      buttons: [{name: "Close"}],
      buttonCustomHTML: "<a class=\"guider_button\" style=\"float:right\" onClick=\"selectApp(1); guider.next();\">Next</a>",
      description: "<?php 
      if ($level == 3) {
        echo 'You can manage students, update the class calendar, create forums, share files, and open LiveLectures using this page.';
      } elseif ($level == 1) {
        echo 'You can view the class calendar, participate in forums, access class files, and view LiveLectures using this page.';
      }
      ?>",
      id: "first",
      next: "second",
      overlay: true,
      title: "This is a class page."
    }).show();


    <?php 
      if ($level == 3) {
        // TEACHERS ONLY
?>
    guider.createGuider({
      attachTo: "#app1",
      buttons: [{name: "Close"}],
      buttonCustomHTML: "<a class=\"guider_button\" style=\"float:right\" onClick=\"selectApp(2); guider.next();\">Next</a>",
      description: "Use the class page to update & communicate with your class. You can also edit the class name & description, view the class code (students need this to enroll), and manage students.",
      id: "second",
      next: "third",
      position: 7,
      title: "Your class homepage.",
      width: 400
    });

    guider.createGuider({
      attachTo: "#app2",
      buttons: [{name: "Close"}],
      buttonCustomHTML: "<a class=\"guider_button\" style=\"float:right\" onClick=\"selectApp(3); guider.next();\">Next</a>",
      description: "Simply click a day in the calendar to add an assignment, project, test or event. You can view the calendar in month, week and day views using the buttons at the top right.<br /><br />You can also sync this class calendar with your other classes, eliminating the need to enter in events multiple times.",
      id: "third",
      next: "fourth",
      position: 7,
      title: "Your class calendar.",
      width: 400
    });

    guider.createGuider({
      attachTo: "#app3",
      buttons: [{name: "Close"}],
      buttonCustomHTML: "<a class=\"guider_button\" style=\"float:right\" onClick=\"selectApp(4); guider.next();\">Next</a>",
      description: "Create forums for your students to communicate in. You can lock and delete forums at any time. Students cannot delete replies they have posted which ensures good behavior.",
      id: "fourth",
      next: "fifth",
      position: 7,
      title: "Class forums for collaboration.",
      width: 400
    });

    guider.createGuider({
      attachTo: "#app4",
      buttons: [{name: "Close"}],
      buttonCustomHTML: "<a class=\"guider_button\" style=\"float:right\" onClick=\"selectApp(5); guider.next();\">Next</a>",
      description: "Upload, bookmark and organize your class content in <a href=\"filebox.cc\">FileBox</a> and then share it with your classes. Students can see the content you share in their class' ShareBox.",
      id: "fifth",
      next: "sixth",
      position: 7,
      title: "Share files, websites and more.",
      width: 400
    });

    guider.createGuider({
      attachTo: "#app5",
      buttons: [{name: "Close"}],
      description: "Open Presentations you've created using ClassConnect and deliver them directly to students along with an optional video stream. <a href=\"#\">Click here</a> to see a demo of LiveLecture in action.",
      id: "sixth",
      position: 7,
      title: "Deliver presentations in real time.",
      width: 400
    });
<?php
      } elseif ($level == 1) {
        // STUDENTS ONLY
?>
    guider.createGuider({
      attachTo: "#app1",
      buttons: [{name: "Close"}],
      buttonCustomHTML: "<a class=\"guider_button\" style=\"float:right\" onClick=\"selectApp(2); guider.next();\">Next</a>",
      description: "Use the class page to view updates from your teacher & communicate with your class.",
      id: "second",
      next: "third",
      position: 7,
      title: "Your class homepage.",
      width: 400
    });

    guider.createGuider({
      attachTo: "#app2",
      buttons: [{name: "Close"}],
      buttonCustomHTML: "<a class=\"guider_button\" style=\"float:right\" onClick=\"selectApp(3); guider.next();\">Next</a>",
      description: "The class calendar shows all upcoming tests, projects, assignments and events. You can view the calendar in month, week and day views using the buttons at the top right.",
      id: "third",
      next: "fourth",
      position: 7,
      title: "Your class calendar.",
      width: 400
    });

    guider.createGuider({
      attachTo: "#app3",
      buttons: [{name: "Close"}],
      buttonCustomHTML: "<a class=\"guider_button\" style=\"float:right\" onClick=\"selectApp(4); guider.next();\">Next</a>",
      description: "Participate in forums with your teacher and fellow classmates. You cannot delete replies you have posted which ensures good behavior.",
      id: "fourth",
      next: "fifth",
      position: 7,
      title: "Class forums for collaboration.",
      width: 400
    });

    guider.createGuider({
      attachTo: "#app4",
      buttons: [{name: "Close"}],
      buttonCustomHTML: "<a class=\"guider_button\" style=\"float:right\" onClick=\"selectApp(5); guider.next();\">Next</a>",
      description: "View files, websites, videos and more that your teacher has shared with you using ShareBox. You can save and access your own personal files on ClassConnect using <a href=\"filebox.cc\">FileBox</a>.",
      id: "fifth",
      next: "sixth",
      position: 7,
      title: "Access class content.",
      width: 400
    });

    guider.createGuider({
      attachTo: "#app5",
      buttons: [{name: "Close"}],
      description: "LiveLecture allows you to view presentations that your teacher is giving along with an optional video stream. <a href=\"#\">Click here</a> to see a demo of LiveLecture in action.",
      id: "sixth",
      position: 7,
      title: "View presentations in real time.",
      width: 400
    });
<?php
      }
      ?>
